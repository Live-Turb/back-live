<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\ViewStatistic;
use App\Models\VideoDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class TrackViewsMiddleware
{
    /**
     * Lista de serviços de geolocalização de backup
     */
    private $geoipServices = [
        'http://ip-api.com/json/%s?fields=status,message,countryCode,city&lang=pt-BR',
        'https://ipapi.co/%s/json/',
        'https://ipwhois.app/json/%s'
    ];

    public function handle(Request $request, Closure $next)
    {
        // Marca o início do processamento do middleware
        Log::info("---- INÍCIO DO PROCESSAMENTO DO TRACKVIEWSMIDDLEWARE ----");
        Log::info("Rota acessada: " . $request->fullUrl());

        // Se não estiver autenticado, não precisa verificar limites
        if (!auth()->check()) {
            Log::info("Usuário não autenticado. Pulando verificação de limites.");
            return $next($request);
        }

        Log::info("Usuário autenticado: ID " . auth()->id() . ", Email: " . auth()->user()->email);

        // Verifica se o usuário está bloqueado
        $billingControl = \App\Models\UserBillingControl::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'pending_amount' => 0,
                'is_blocked' => false,
                'block_reason' => null,
                'last_ip' => $request->ip(),
                'device_fingerprint' => md5($request->userAgent())
            ]
        );

        if ($billingControl->is_blocked) {
            return response()->view('billing.blocked', [
                'pending_amount' => $billingControl->pending_amount,
                'block_reason' => $billingControl->block_reason
            ], 403);
        }

        // Verifica se vai ultrapassar o limite de cobranças
        $currentMonthViews = \App\Models\ViewStatistic::where('user_id', auth()->id())
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $extraViews = max(0, $currentMonthViews + 1 - 6000); // +1 para contar a visualização atual
        $totalPendingAmount = floor($extraViews / 500) * 10.00;

        if ($totalPendingAmount >= 100.00) {
            return response()->view('billing.limit_exceeded', [
                'current_views' => $currentMonthViews,
                'extra_views' => $extraViews,
                'pending_amount' => $totalPendingAmount
            ], 403);
        }

        // Se chegou aqui, pode prosseguir com a visualização
        $response = $next($request);

        try {
            // Gera uma sessão única para o usuário
            $session = session()->get('viewer_session');
            if (!$session) {
                $session = Str::random(40);
                session()->put('viewer_session', $session);
            }

            // Configura o Agent para detecção de dispositivo
            $agent = new Agent();

            // Detecta o IP real do usuário considerando proxies e VPNs
            $ip = $this->getClientIp($request);

            // Tenta obter o template_id da rota
            $templateId = null;
            $uuid = $request->route('uuid');

            Log::info("Analisando UUID da rota: " . ($uuid ?: 'Não encontrado'));

            // Registra todos os parâmetros da rota para diagnóstico
            Log::info("Todos os parâmetros da rota: ", $request->route()->parameters());

            // Registra informações sobre a rota atual
            Log::info("Nome da rota: " . $request->route()->getName());
            Log::info("Ação da rota: " . $request->route()->getActionName());

            if ($uuid) {
                // Busca o template pelo UUID
                Log::info("Buscando template pelo UUID: {$uuid}");
                $template = \App\Models\VideoDetail::where('uuid', $uuid)->first();
                if ($template) {
                    $templateId = $template->id;
                    Log::info("Template encontrado: ID {$templateId}, UUID {$uuid}, Título: " . ($template->title ?? 'Sem título'));

                    // Verificar se o template pertence a algum usuário
                    if ($template->user_id) {
                        Log::info("Template pertence ao usuário ID: {$template->user_id}");
                    } else {
                        Log::warning("Template sem usuário associado: {$uuid}");
                    }
                } else {
                    Log::warning("Template não encontrado para UUID: {$uuid}. Verificando se existe no banco de dados...");

                    // Verificar se o UUID existe no banco de dados
                    $exists = DB::table('video_details')->where('uuid', $uuid)->exists();
                    Log::info("UUID {$uuid} existe no banco? " . ($exists ? 'SIM' : 'NÃO'));

                    // Verificar se há algum template com UUID semelhante
                    $similar = DB::table('video_details')
                        ->where('uuid', 'like', substr($uuid, 0, 8) . '%')
                        ->select('id', 'uuid', 'title')
                        ->limit(3)
                        ->get();

                    if ($similar->count() > 0) {
                        Log::info("Templates com UUID similar encontrados: ", $similar->toArray());
                    }
                }
            } else {
                Log::warning("UUID não encontrado na rota. Parâmetros da rota: ", [
                    'parameters' => $request->route()->parameters(),
                    'uri' => $request->getRequestUri(),
                    'method' => $request->method()
                ]);
            }

            // Registra a visualização
            $viewData = [
                'user_id' => auth()->id(),
                'template_id' => $templateId,
                'viewer_ip' => $ip,
                'viewer_session' => $session,
                'device_type' => $agent->isMobile() ? 'mobile' : ($agent->isTablet() ? 'tablet' : 'desktop'),
                'browser' => $agent->browser(),
                'os' => $agent->platform(),
                'referrer_domain' => parse_url($request->header('referer'), PHP_URL_HOST) ?? null,
                'referrer_url' => $request->header('referer'),
                'utm_source' => $request->get('utm_source'),
                'utm_medium' => $request->get('utm_medium'),
                'utm_campaign' => $request->get('utm_campaign'),
                'is_unique' => true // Será atualizado pelo serviço
            ];

            // Log dos dados que serão salvos
            Log::info("Registrando visualização com os seguintes dados:", [
                'template_id' => $viewData['template_id'],
                'user_id' => $viewData['user_id'],
                'session' => $viewData['viewer_session'],
                'device' => $viewData['device_type'],
                'browser' => $viewData['browser'],
                'os' => $viewData['os']
            ]);

            // Tenta obter a localização do IP
            try {
                $location = $this->getLocationFromMultipleServices($ip);

                Log::info("Dados de localização:", [
                    'ip' => $ip,
                    'location' => $location
                ]);

                if ($location && !empty($location['country_code'])) {
                    $viewData['country'] = strtoupper($location['country_code']);
                    $viewData['city'] = $location['city'] ?? null;
                    Log::info("País detectado: {$viewData['country']} para IP: {$ip}");
                } else {
                    Log::warning("Não foi possível detectar o país para o IP: {$ip}", [
                        'location_data' => $location
                    ]);
                    $viewData['country'] = 'XX'; // Código especial para Desconhecido
                    $viewData['city'] = 'Desconhecido';
                }
            } catch (\Exception $e) {
                Log::error("Erro ao obter localização para IP {$ip}: " . $e->getMessage(), [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => $e->getTraceAsString()
                    ]
                ]);
                $viewData['country'] = 'XX'; // Código especial para Desconhecido
                $viewData['city'] = 'Desconhecido';
            }

            // Salvar na base de dados e registrar o ID gerado
            $viewStatistic = ViewStatistic::create($viewData);
            Log::info("Visualização registrada com sucesso. ID gerado: " . $viewStatistic->id);

        } catch (\Exception $e) {
            Log::error('Erro ao registrar visualização: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }

        Log::info("---- FIM DO PROCESSAMENTO DO TRACKVIEWSMIDDLEWARE ----");
        return $response;
    }

    /**
     * Tenta obter a localização do IP usando múltiplos serviços
     */
    private function getLocationFromMultipleServices($ip)
    {
        // Para IPs locais, definir como Brasil para fins de teste
        if ($this->isLocalIp($ip)) {
            Log::info("IP local detectado: {$ip}, definindo país como Brasil para testes");
            return [
                'country_code' => 'BR',
                'city' => 'São Paulo'
            ];
        }

        // Primeiro tenta usar o serviço configurado no GeoIP
        try {
            $location = geoip()->getLocation($ip);
            if ($location && !empty($location->iso_code)) {
                Log::info("Localização obtida via GeoIP principal: {$location->iso_code}, {$location->city}");
                return [
                    'country_code' => $location->iso_code,
                    'city' => $location->city
                ];
            }
        } catch (\Exception $e) {
            Log::warning("Falha no serviço principal de GeoIP: " . $e->getMessage());
        }

        // Se falhar, tenta os serviços de backup
        foreach ($this->geoipServices as $serviceUrl) {
            try {
                $url = sprintf($serviceUrl, $ip);
                Log::info("Tentando obter localização via: {$url}");

                $response = Http::timeout(10)->get($url);

                if ($response->successful()) {
                    $data = $response->json();
                    Log::info("Resposta do serviço {$serviceUrl}:", ['data' => $data]);

                    // IP-API.com
                    if (isset($data['countryCode'])) {
                        $city = isset($data['city']) ? $data['city'] : 'Cidade desconhecida';
                        Log::info("Localização obtida via IP-API: {$data['countryCode']}, {$city}");
                        return [
                            'country_code' => $data['countryCode'],
                            'city' => isset($data['city']) ? $data['city'] : null
                        ];
                    }
                    // ipapi.co
                    else if (isset($data['country_code'])) {
                        $city = isset($data['city']) ? $data['city'] : 'Cidade desconhecida';
                        Log::info("Localização obtida via ipapi.co: {$data['country_code']}, {$city}");
                        return [
                            'country_code' => $data['country_code'],
                            'city' => isset($data['city']) ? $data['city'] : null
                        ];
                    }
                    // ipwhois.app
                    else if (isset($data['country_code'])) {
                        $city = isset($data['city']) ? $data['city'] : 'Cidade desconhecida';
                        Log::info("Localização obtida via ipwhois.app: {$data['country_code']}, {$city}");
                        return [
                            'country_code' => $data['country_code'],
                            'city' => isset($data['city']) ? $data['city'] : null
                        ];
                    }
                } else {
                    Log::warning("Resposta não bem-sucedida do serviço {$serviceUrl}: " . $response->status() . " - " . $response->body());
                }
            } catch (\Exception $e) {
                Log::warning("Falha no serviço de backup {$serviceUrl}: " . $e->getMessage());
                continue;
            }
        }

        // Se todos os serviços falharem, usar um país padrão para fins de teste
        Log::warning("Todos os serviços de geolocalização falharam para o IP: {$ip}. Usando país padrão.");
        return [
            'country_code' => 'XX',
            'city' => 'Desconhecido'
        ];
    }

    /**
     * Verifica se o IP é local
     */
    private function isLocalIp($ip)
    {
        return in_array($ip, ['127.0.0.1', '::1']) ||
               preg_match('/^192\.168\./', $ip) ||
               preg_match('/^10\./', $ip) ||
               preg_match('/^172\.(1[6-9]|2[0-9]|3[0-1])\./', $ip);
    }

    /**
     * Obtém o IP real do cliente, considerando headers de proxy
     */
    private function getClientIp(Request $request)
    {
        // Lista de headers que podem conter o IP real
        $headers = [
            'HTTP_CF_CONNECTING_IP', // Cloudflare
            'HTTP_X_REAL_IP',       // Nginx proxy
            'HTTP_X_FORWARDED_FOR', // Proxy genérico
            'HTTP_CLIENT_IP',       // Proxy genérico
            'REMOTE_ADDR'           // IP direto
        ];

        foreach ($headers as $header) {
            $ip = $request->server($header);

            if ($ip) {
                // Se for uma lista de IPs (X-Forwarded-For pode conter vários)
                if (strpos($ip, ',') !== false) {
                    $ips = array_map('trim', explode(',', $ip));
                    $ip = $ips[0]; // Pega o primeiro IP (mais próximo do cliente)
                }

                // Valida se é um IP válido
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    Log::info("IP detectado via {$header}: {$ip}");
                    return $ip;
                }
            }
        }

        // Fallback para o método padrão do Laravel
        $ip = $request->ip();
        Log::info("IP detectado via método padrão: {$ip}");
        return $ip;
    }
}
