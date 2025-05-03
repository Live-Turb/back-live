<?php

namespace App\Http\Controllers;

use App\Models\ViewStatistic;
use App\Models\VideoDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnalyticsExport;
use Misd\PhoneNumber\PhoneNumberUtil;

class ViewAnalyticsController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = auth()->user();

        if (RateLimiter::tooManyAttempts("analytics-dashboard-{$user->id}", 60)) {
            return response()->json([
                'message' => 'Too many requests. Please try again later.',
                'retry_after' => RateLimiter::availableIn("analytics-dashboard-{$user->id}")
            ], 429);
        }

        RateLimiter::hit("analytics-dashboard-{$user->id}");

        $period = $request->get('period', '30');
        $videoId = $request->get('video_id');
        $isRefresh = $request->has('refresh');

        // Preparar dados para os filtros
        $countries = $this->getAvailableCountries();
        $referrers = $this->getAvailableReferrers();
        $campaigns = $this->getAvailableCampaigns();
        $devices = $this->getAvailableDevices();

        $cacheKey = $this->buildCacheKey($request->all());

        // Se for uma requisição de atualização, remover o cache
        if ($isRefresh) {
            Cache::forget($cacheKey);
        }

        $analytics = Cache::remember($cacheKey, now()->addHours(1), function () use ($request, $user, $period) {
            $query = $this->buildAnalyticsQuery($request, $user);

            return [
                'total_views' => $this->getTotalViews($query->clone()),
                'unique_views' => $this->getUniqueViews($query->clone()),
                'views_by_day' => $this->getViewsByDay($query->clone()),
                'device_breakdown' => $this->getDeviceBreakdown($query->clone()),
                'browser_stats' => $this->getBrowserStats($query->clone()),
                'os_stats' => $this->getOsStats($query->clone()),
                'top_referrers' => $this->getTopReferrers($query->clone()),
                'peak_hours' => $this->getPeakHours($query->clone()),
                'campaign_stats' => $this->getCampaignStats($query->clone()),
                'period_comparison' => $this->getPeriodComparison($query->clone(), $period),
                'hourly_breakdown' => $this->getHourlyBreakdown($query->clone()),
                'geo_stats' => $this->getGeoStats($query->clone())
            ];
        });

        $videos = VideoDetail::where('user_id', $user->id)->get();

        // Se for uma requisição AJAX, retornar apenas os dados em JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'analytics' => $analytics,
                'updated_at' => now()->format('Y-m-d H:i:s')
            ]);
        }

        return view('analytics.dashboard', compact(
            'analytics',
            'videos',
            'period',
            'videoId',
            'countries',
            'referrers',
            'campaigns',
            'devices'
        ));
    }

    private function buildAnalyticsQuery(Request $request, $user)
    {
        $query = ViewStatistic::query()
            ->where('user_id', $user->id);

        // Filtro de período padrão ou datas específicas
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        } else {
            $query->where('created_at', '>=', now()->subDays($request->get('period', 30)));
        }

        // Filtros avançados
        if ($request->filled('video_id')) {
            $query->where('template_id', $request->video_id);
        }

        if ($request->filled('device_type')) {
            $query->where('device_type', $request->device_type);
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('referrer')) {
            $query->where('referrer_domain', $request->referrer);
        }

        if ($request->filled('campaign')) {
            $query->where('utm_campaign', $request->campaign);
        }

        return $query;
    }

    private function buildCacheKey(array $params)
    {
        $userId = auth()->id();
        // Adiciona um timestamp em segundos para garantir dados mais frescos em requisições de refresh
        if (isset($params['refresh']) && $params['refresh']) {
            $timestamp = now()->format('YmdHis');
            return "analytics_{$userId}_{$timestamp}_" . md5(json_encode($params));
        }
        return "analytics_{$userId}_" . md5(json_encode($params));
    }

    private function getAvailableCountries()
    {
        $userId = auth()->id();
        return Cache::remember("available_countries_{$userId}", now()->addDay(), function () use ($userId) {
            return ViewStatistic::where('user_id', $userId)
                ->distinct()
                ->whereNotNull('country')
                ->pluck('country')
                ->sort()
                ->mapWithKeys(function ($code) {
                    return [$code => $this->getCountryName($code)];
                });
        });
    }

    private function getCountryName($countryCode)
    {
        // Normalizar o código para maiúsculas
        $countryCode = strtoupper(trim($countryCode));

        // Log para debug
        Log::info("Obtendo nome para o código de país: {$countryCode}");

        // Códigos especiais
        if ($countryCode === 'XX' || empty($countryCode)) {
            return 'Desconhecido';
        }

        // Mapeamento manual de códigos de país para nomes em português
        $countryMap = [
            'US' => 'Estados Unidos',
            'BR' => 'Brasil',
            'PT' => 'Portugal',
            'ES' => 'Espanha',
            'MX' => 'México',
            'CO' => 'Colômbia',
            'AR' => 'Argentina',
            'CL' => 'Chile',
            'PE' => 'Peru',
            'UY' => 'Uruguai',
            'PY' => 'Paraguai',
            'BO' => 'Bolívia',
            'VE' => 'Venezuela',
            'EC' => 'Equador',
            'CA' => 'Canadá',
            'FR' => 'França',
            'DE' => 'Alemanha',
            'IT' => 'Itália',
            'GB' => 'Reino Unido',
            'JP' => 'Japão',
            'AU' => 'Austrália',
            'RU' => 'Rússia',
            'IN' => 'Índia',
            'CN' => 'China',
            'ZA' => 'África do Sul',
            'AO' => 'Angola',
            'MZ' => 'Moçambique'
        ];

        // Verificar primeiro no mapeamento manual
        if (isset($countryMap[$countryCode])) {
            return $countryMap[$countryCode];
        }

        // Tentar usar a classe Locale se disponível
        if (class_exists('Locale')) {
            try {
                $name = \Locale::getDisplayRegion("-" . $countryCode, 'pt');

                if (substr($name, 0, 1) === '-') {
                    $name = substr($name, 1);
                }

                if (!empty($name) && $name !== "-$countryCode") {
                    return $name;
                }
            } catch (\Exception $e) {
                Log::error("Erro ao usar Locale para {$countryCode}: " . $e->getMessage());
            }
        }

        // Se não conseguir obter o nome, retornar o código
        Log::warning("Nome de país não encontrado para o código: {$countryCode}");
        return $countryCode;
    }

    private function getAvailableReferrers()
    {
        $userId = auth()->id();
        return Cache::remember("available_referrers_{$userId}", now()->addHours(12), function () use ($userId) {
            return ViewStatistic::where('user_id', $userId)
                ->distinct()
                ->pluck('referrer_domain')
                ->sort();
        });
    }

    private function getAvailableCampaigns()
    {
        $userId = auth()->id();
        return Cache::remember("available_campaigns_{$userId}", now()->addHours(12), function () use ($userId) {
            return ViewStatistic::where('user_id', $userId)
                ->distinct()
                ->whereNotNull('utm_campaign')
                ->pluck('utm_campaign')
                ->sort();
        });
    }

    private function getAvailableDevices()
    {
        $userId = auth()->id();
        return Cache::remember("available_devices_{$userId}", now()->addHours(12), function () use ($userId) {
            return ViewStatistic::where('user_id', $userId)
                ->distinct()
                ->whereNotNull('device_type')
                ->pluck('device_type')
                ->sort()
                ->values()
                ->all();
        });
    }

    private function getHourlyBreakdown($query)
    {
        return $query->select(
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN is_unique = 1 THEN 1 ELSE 0 END) as unique_views')
        )
        ->groupBy('hour')
        ->orderBy('hour')
        ->get()
        ->mapWithKeys(function ($item) {
            return [
                sprintf('%02d:00', $item->hour) => [
                    'total' => $item->total,
                    'unique' => $item->unique_views
                ]
            ];
        });
    }

    private function getGeoStats($query)
    {
        $userId = auth()->id();
        $videoId = request()->get('video_id');
        $isFiltered = !empty($videoId);
        $isRefresh = request()->has('refresh');

        // Construir uma chave de cache que inclui o ID do vídeo se estiver sendo filtrado
        $cacheKey = "geo_stats_{$userId}_" . ($isFiltered ? "video_{$videoId}_" : "all_videos_") . md5($query->toSql());

        // Se for uma solicitação de atualização, limpar o cache
        if ($isRefresh) {
            Cache::forget($cacheKey);
            Log::info("Cache limpo para a chave: {$cacheKey} (refresh solicitado)");
        }

        // Reduza o tempo de cache para 5 segundos para ter dados mais recentes
        return Cache::remember($cacheKey, now()->addSeconds(5), function () use ($query, $isFiltered, $videoId, $userId) {
            // Log para debug
            Log::info("Executando consulta de dados geográficos " . ($isFiltered ? "para o vídeo ID: {$videoId}" : "") . ". Usando query filtrada.");

            $stats = null;

            // Clone a query para não afetar o objeto original quando estamos filtrando por vídeo
            $statsQuery = clone $query;

            $stats = $statsQuery->select(
                DB::raw('IFNULL(country, "XX") as country'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN is_unique = 1 THEN 1 ELSE 0 END) as unique_views')
            )
            ->where(function($q) {
                $q->whereNotNull('country')
                ->orWhere('country', '!=', '');
            })
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

            Log::info("Usando query filtrada para o vídeo ID: {$videoId}, encontrados: " . $stats->count() . " países");

            // Definir caminhos para as bandeiras dos países
            $flagsPath = base_path('../storage/bandeiras_mundo');
            $publicPath = 'storage/bandeiras_mundo';

            // Verificar se o diretório de bandeiras existe
            if (!file_exists($flagsPath)) {
                Log::warning("Diretório de bandeiras não encontrado: {$flagsPath}");
                // Tentar caminhos alternativos
                $alternativePaths = [
                    public_path('storage/bandeiras_mundo'),
                    base_path('AppLaravel/public/storage/bandeiras_mundo'),
                    base_path('storage/bandeiras_mundo'),
                    base_path('../storage/bandeiras_mundo'),
                    storage_path('app/public/bandeiras_mundo'),
                    base_path('public/storage/bandeiras_mundo')
                ];

                foreach ($alternativePaths as $path) {
                    if (file_exists($path)) {
                        $flagsPath = $path;
                        Log::info("Usando diretório de bandeiras alternativo: {$flagsPath}");
                        break;
                    }
                }

                if (!file_exists($flagsPath)) {
                    Log::error("Nenhum diretório de bandeiras encontrado!");
                }
            }

            // Verificar se há algum resultado
            if ($stats->isEmpty()) {
                Log::warning("Nenhum dado geográfico encontrado na consulta");
            }

            $result = $stats->map(function ($item) use ($flagsPath, $publicPath) {
                // Obter o código do país do banco de dados
                $rawCountryCode = $item->country;

                // Se o código do país for vazio, null ou "xx", substituir por 'xx'
                $countryCode = (empty($rawCountryCode)) ? 'xx' : $rawCountryCode;

                // Obter o nome do país usando o código original
                $countryName = $this->getCountryName($countryCode);

                // Converter o código do país para minúsculas para o arquivo da bandeira
                $lowerCountryCode = strtolower($countryCode);

                // Verificar se o arquivo da bandeira existe
                $flagFile = "{$flagsPath}/{$lowerCountryCode}.png";
                $flagExists = file_exists($flagFile);

                return [
                    'country' => $countryCode,
                    'country_name' => $countryName,
                    'country_code' => $countryCode,
                    'total' => $item->total,
                    'unique_views' => $item->unique_views,
                    'flag_path' => $flagExists ? "{$publicPath}/{$lowerCountryCode}.png" : "{$publicPath}/xx.png"
                ];
            });

            Log::info("Total de países processados: " . count($result));
            return $result->toArray();
        });
    }

    private function getDeviceBreakdown($query)
    {
        $results = $query->select('device_type', DB::raw('COUNT(*) as count'))
            ->groupBy('device_type')
            ->orderByDesc('count')
            ->get();

        // Se não houver dados, retorna um array com valores zerados
        if ($results->isEmpty()) {
            return [
                'desktop' => 0,
                'mobile' => 0,
                'tablet' => 0
            ];
        }

        // Mapeia os resultados para o formato esperado
        $deviceCounts = $results->mapWithKeys(function ($item) {
            return [$item->device_type => $item->count];
        })->all();

        // Garante que todos os tipos de dispositivo estejam presentes
        $defaultDevices = [
            'desktop' => 0,
            'mobile' => 0,
            'tablet' => 0
        ];

        return array_merge($defaultDevices, $deviceCounts);
    }

    public function export(Request $request)
    {
        $user = auth()->user();

        if (RateLimiter::tooManyAttempts("analytics-export-{$user->id}", 10)) {
            return response()->json([
                'message' => 'Too many export requests. Please try again later.',
                'retry_after' => RateLimiter::availableIn("analytics-export-{$user->id}")
            ], 429);
        }

        RateLimiter::hit("analytics-export-{$user->id}");

        $period = $request->get('period', '30');
        $videoId = $request->get('video_id');
        $startDate = now()->subDays($period);

        $query = ViewStatistic::query()
            ->when($videoId, function ($q) use ($videoId) {
                return $q->where('template_id', $videoId);
            })
            ->where('user_id', $user->id)
            ->where('created_at', '>=', $startDate)
            ->orderBy('created_at', 'desc');

        return Excel::download(
            new AnalyticsExport($query),
            "analytics-report-{$period}days.xlsx"
        );
    }

    private function getTotalViews($query)
    {
        return $query->count();
    }

    private function getUniqueViews($query)
    {
        return $query->where('is_unique', true)->count();
    }

    private function getViewsByDay($query)
    {
        return $query->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN is_unique = 1 THEN 1 ELSE 0 END) as unique_views')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->map(function ($item) {
            return [
                'date' => $item->date,
                'total' => $item->total,
                'unique' => $item->unique_views
            ];
        });
    }

    private function getBrowserStats($query)
    {
        return $query->select('browser', DB::raw('COUNT(*) as count'))
            ->groupBy('browser')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }

    private function getOsStats($query)
    {
        return $query->select('os', DB::raw('COUNT(*) as count'))
            ->groupBy('os')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }

    private function getTopReferrers($query)
    {
        $userId = auth()->id();
        $cacheKey = "top_referrers_{$userId}_" . md5($query->toSql());

        return Cache::remember($cacheKey, now()->addHours(1), function () use ($query) {
            return $query->whereNotNull('referrer_domain')
                ->select('referrer_domain', DB::raw('COUNT(*) as count'))
                ->groupBy('referrer_domain')
                ->orderByDesc('count')
                ->paginate(10);
        });
    }

    private function getPeakHours($query)
    {
        return $query->select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->mapWithKeys(function ($item) {
                return [sprintf('%02d:00', $item->hour) => $item->count];
            });
    }

    private function getCampaignStats($query)
    {
        $userId = auth()->id();
        $cacheKey = "campaign_stats_{$userId}_" . md5($query->toSql());

        return Cache::remember($cacheKey, now()->addHours(1), function () use ($query) {
            return [
                'sources' => $query->whereNotNull('utm_source')
                    ->select('utm_source', DB::raw('COUNT(*) as count'))
                    ->groupBy('utm_source')
                    ->orderByDesc('count')
                    ->limit(5)
                    ->get(),
                'mediums' => $query->whereNotNull('utm_medium')
                    ->select('utm_medium', DB::raw('COUNT(*) as count'))
                    ->groupBy('utm_medium')
                    ->orderByDesc('count')
                    ->limit(5)
                    ->get(),
                'campaigns' => $query->whereNotNull('utm_campaign')
                    ->select('utm_campaign', DB::raw('COUNT(*) as count'))
                    ->groupBy('utm_campaign')
                    ->orderByDesc('count')
                    ->limit(5)
                    ->get()
            ];
        });
    }

    private function getPeriodComparison($query, $previousPeriod)
    {
        $userId = auth()->id();
        $cacheKey = "period_comparison_{$userId}_{$previousPeriod}_" . md5($query->toSql());

        return Cache::remember($cacheKey, now()->addHours(1), function () use ($query, $previousPeriod) {
            $currentPeriodStats = $query->count();

            $previousStartDate = now()->subDays($previousPeriod * 2);
            $previousEndDate = now()->subDays($previousPeriod);

            // Cria uma nova query para o período anterior
            $previousQuery = $query->clone()->whereBetween('created_at', [$previousStartDate, $previousEndDate]);
            $previousPeriodStats = $previousQuery->count();

            $percentageChange = $previousPeriodStats > 0
                ? (($currentPeriodStats - $previousPeriodStats) / $previousPeriodStats) * 100
                : 100;

            return [
                'current_period' => $currentPeriodStats,
                'previous_period' => $previousPeriodStats,
                'percentage_change' => round($percentageChange, 2)
            ];
        });
    }
}
