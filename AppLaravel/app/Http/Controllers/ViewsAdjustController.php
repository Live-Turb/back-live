<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TemplateView;
use App\Models\ViewStatistic;
use App\Models\VideoDetail;
use App\Models\ViewBillingRecord;
use App\Models\UserBillingControl;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ViewTrackingService;

class ViewsAdjustController extends Controller
{
    public function resetViews($email)
    {
        try {
            DB::beginTransaction();

            $user = User::where('email', $email)->firstOrFail();

            // Pega contagem atual
            $currentViews = ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count();

            // Deleta todas as visualizações do mês atual
            ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            TemplateView::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            // Limpa registros de cobrança pendentes
            DB::table('view_billing_records')
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->delete();

            // Reseta o controle de billing
            DB::table('user_billing_controls')
                ->where('user_id', $user->id)
                ->update([
                    'pending_amount' => 0,
                    'is_blocked' => false,
                    'block_reason' => null
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Visualizações resetadas com sucesso',
                'data' => [
                    'previous_views' => $currentViews,
                    'current_views' => 0,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function setViews($email, $count)
    {
        try {
            DB::beginTransaction();

            $user = User::where('email', $email)->firstOrFail();
            
            // Primeiro reseta as visualizações
            ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            TemplateView::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            // Pega o primeiro vídeo do usuário
            $video = $user->videoDetails()->first();
            if (!$video) {
                throw new \Exception('Usuário não possui vídeos');
            }

            // Cria novas visualizações
            $views = [];
            $viewStats = [];
            $now = Carbon::now();

            for ($i = 0; $i < $count; $i++) {
                $views[] = [
                    'user_id' => $user->id,
                    'template_id' => $video->id,
                    'viewer_ip' => '127.0.0.1',
                    'viewer_session' => 'test-session',
                    'user_agent' => 'Test Agent',
                    'created_at' => $now,
                    'updated_at' => $now
                ];

                $viewStats[] = [
                    'user_id' => $user->id,
                    'template_id' => $video->id,
                    'viewer_ip' => '127.0.0.1',
                    'viewer_session' => 'test-session',
                    'device_type' => 'desktop',
                    'browser' => 'Chrome',
                    'os' => 'Windows',
                    'is_unique' => true,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            // Insere em lotes
            foreach (array_chunk($views, 100) as $chunk) {
                TemplateView::insert($chunk);
            }

            foreach (array_chunk($viewStats, 100) as $chunk) {
                ViewStatistic::insert($chunk);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Visualizações ajustadas com sucesso',
                'data' => [
                    'views_set' => $count,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function adjustViews(Request $request)
    {
        try {
            \Log::info('Iniciando ajuste de visualizações', [
                'email' => $request->email,
                'count' => $request->count
            ]);

            if (!$request->has(['email', 'count'])) {
                return response()->json([
                    'error' => 'Email e contagem são obrigatórios'
                ], 400);
            }

            $email = $request->input('email');
            $count = (int)$request->input('count');

            DB::beginTransaction();

            $user = User::where('email', $email)->firstOrFail();

            \Log::info('Usuário encontrado', [
                'user_id' => $user->id,
                'name' => $user->name
            ]);

            // Limpa visualizações existentes
            ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            TemplateView::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            // Limpa registros de cobrança pendentes
            DB::table('view_billing_records')
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->delete();

            // Reseta controle de billing
            DB::table('user_billing_controls')
                ->updateOrInsert(
                    ['user_id' => $user->id],
                    [
                        'pending_amount' => 0,
                        'is_blocked' => false,
                        'block_reason' => null,
                        'last_ip' => request()->ip(),
                        'device_fingerprint' => md5('test-agent'),
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );

            // Pega o primeiro vídeo do usuário
            $video = VideoDetail::where('user_id', $user->id)->first();
            if (!$video) {
                throw new \Exception('Usuário não possui vídeos');
            }

            // Cria novas visualizações
            $views = [];
            $viewStats = [];
            $now = Carbon::now();

            for ($i = 0; $i < $count; $i++) {
                $views[] = [
                    'user_id' => $user->id,
                    'template_id' => $video->id,
                    'viewer_ip' => '127.0.0.1',
                    'viewer_session' => 'test-session',
                    'user_agent' => 'Test Agent',
                    'created_at' => $now,
                    'updated_at' => $now
                ];

                $viewStats[] = [
                    'user_id' => $user->id,
                    'template_id' => $video->id,
                    'viewer_ip' => '127.0.0.1',
                    'viewer_session' => 'test-session',
                    'device_type' => 'desktop',
                    'browser' => 'Chrome',
                    'os' => 'Windows',
                    'is_unique' => true,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            // Insere em lotes
            foreach (array_chunk($views, 100) as $chunk) {
                TemplateView::insert($chunk);
            }

            foreach (array_chunk($viewStats, 100) as $chunk) {
                ViewStatistic::insert($chunk);
            }

            DB::commit();

            \Log::info('Visualizações ajustadas', [
                'user_id' => $user->id,
                'requested_views' => $count,
                'billing_control' => DB::table('user_billing_controls')
                    ->where('user_id', $user->id)
                    ->first()
            ]);

            // Busca estado atual
            $currentViews = ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count();

            $billingControl = DB::table('user_billing_controls')
                ->where('user_id', $user->id)
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Visualizações ajustadas com sucesso',
                'data' => [
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email
                    ],
                    'views' => [
                        'requested' => $count,
                        'current' => $currentViews
                    ],
                    'billing' => [
                        'pending_amount' => $billingControl ? $billingControl->pending_amount : 0,
                        'is_blocked' => $billingControl ? $billingControl->is_blocked : false
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao ajustar visualizações: ' . $e->getMessage(), [
                'email' => $request->email,
                'count' => $request->count,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function checkBillingStatus($email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();

            // Verifica visualizações do mês atual
            $currentViews = ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count();

            // Busca registros de cobrança pendentes
            $pendingCharges = ViewBillingRecord::where('user_id', $user->id)
                ->where('status', 'pending')
                ->get();

            // Busca controle de billing
            $billingControl = DB::table('user_billing_controls')
                ->where('user_id', $user->id)
                ->first();

            // Verifica se as tabelas existem
            $tables = DB::select("SHOW TABLES LIKE 'view_billing_records'");
            $hasBillingTable = !empty($tables);

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email
                    ],
                    'views' => [
                        'current' => $currentViews,
                        'basic_plan_limit' => 6000,
                        'extra_views' => max(0, $currentViews - 6000)
                    ],
                    'billing' => [
                        'pending_charges' => $pendingCharges->map(function($charge) {
                            return [
                                'id' => $charge->id,
                                'extra_views' => $charge->extra_views,
                                'cost' => $charge->extra_views_cost,
                                'status' => $charge->status,
                                'created_at' => $charge->created_at
                            ];
                        }),
                        'total_pending' => $pendingCharges->sum('extra_views_cost'),
                        'control' => $billingControl,
                        'tables_exist' => [
                            'view_billing_records' => $hasBillingTable
                        ]
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function testBilling(Request $request)
    {
        try {
            $email = $request->email;
            $views = $request->views ?? 6500;

            DB::beginTransaction();

            $user = User::where('email', $email)->firstOrFail();

            // Se views = 0, desbloqueia o usuário
            if ($views === 0) {
                // Limpa registros antigos
                ViewBillingRecord::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->delete();

                // Reseta controle de billing
                $billingControl = UserBillingControl::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'pending_amount' => 0,
                        'is_blocked' => false,
                        'block_reason' => null
                    ]
                );

                $billingControl->pending_amount = 0;
                $billingControl->is_blocked = false;
                $billingControl->block_reason = null;
                $billingControl->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Usuário desbloqueado com sucesso',
                    'billing' => [
                        'pending_amount' => $billingControl->pending_amount,
                        'is_blocked' => $billingControl->is_blocked,
                        'block_reason' => $billingControl->block_reason
                    ]
                ]);
            }

            // Verifica se o usuário já está bloqueado
            $billingControl = UserBillingControl::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'pending_amount' => 0,
                    'is_blocked' => false,
                    'block_reason' => null
                ]
            );

            if ($billingControl->is_blocked) {
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário bloqueado: ' . $billingControl->block_reason,
                    'billing' => [
                        'pending_amount' => $billingControl->pending_amount,
                        'is_blocked' => true,
                        'block_reason' => $billingControl->block_reason
                    ]
                ], 403);
            }

            // Limpa todos os registros antigos primeiro
            ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            TemplateView::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();

            // Limpa registros de cobrança pendentes
            ViewBillingRecord::where('user_id', $user->id)
                ->where('status', 'pending')
                ->delete();

            // Reseta o controle de billing
            $billingControl->pending_amount = 0;
            $billingControl->is_blocked = false;
            $billingControl->block_reason = null;
            $billingControl->save();

            // Cria visualizações de teste
            $video = VideoDetail::where('user_id', $user->id)->first();
            if (!$video) {
                throw new \Exception('Usuário não possui vídeos');
            }

            // Cria as visualizações
            $now = Carbon::now();
            $viewsData = [];
            for ($i = 0; $i < $views; $i++) {
                $viewsData[] = [
                    'user_id' => $user->id,
                    'template_id' => $video->id,
                    'viewer_ip' => '127.0.0.1',
                    'viewer_session' => 'test-session',
                    'device_type' => 'desktop',
                    'browser' => 'Chrome',
                    'os' => 'Windows',
                    'is_unique' => true,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            // Insere em lotes
            foreach (array_chunk($viewsData, 100) as $chunk) {
                ViewStatistic::insert($chunk);
            }

            // Calcula visualizações extras
            $extraViews = max(0, $views - 6000);
            $chargesNeeded = floor($extraViews / 500);

            // Verifica se vai ultrapassar o limite
            $totalPendingAmount = $chargesNeeded * 10.00;
            if ($totalPendingAmount >= 100.00) {
                return response()->json([
                    'success' => false,
                    'error' => 'Esta operação ultrapassaria o limite máximo de cobranças pendentes (R$ 100,00)',
                    'billing' => [
                        'pending_amount' => $totalPendingAmount,
                        'is_blocked' => true,
                        'block_reason' => 'Limite máximo de cobranças pendentes seria ultrapassado'
                    ]
                ], 403);
            }

            // Cria cobranças
            for ($i = 0; $i < $chargesNeeded; $i++) {
                ViewBillingRecord::create([
                    'user_id' => $user->id,
                    'extra_views' => 500,
                    'extra_views_cost' => 10.00,
                    'status' => 'pending',
                    'billing_period_start' => now(),
                    'billing_period_end' => now()->endOfMonth(),
                    'total_views' => $views
                ]);

                $billingControl->pending_amount += 10.00;
            }

            // Atualiza controle
            if ($billingControl->pending_amount >= 100.00) {
                $billingControl->is_blocked = true;
                $billingControl->block_reason = 'Limite máximo de cobranças pendentes atingido (R$ 100,00).';
            }

            $billingControl->save();

            DB::commit();

            // Busca estado atual
            $pendingCharges = ViewBillingRecord::where('user_id', $user->id)
                ->where('status', 'pending')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email
                    ],
                    'views' => [
                        'total' => $views,
                        'extra' => $extraViews,
                        'charges_needed' => $chargesNeeded
                    ],
                    'billing' => [
                        'pending_charges' => $pendingCharges->map(function($charge) {
                            return [
                                'id' => $charge->id,
                                'extra_views' => $charge->extra_views,
                                'cost' => $charge->extra_views_cost,
                                'status' => $charge->status,
                                'created_at' => $charge->created_at
                            ];
                        }),
                        'control' => [
                            'pending_amount' => $billingControl->pending_amount,
                            'is_blocked' => $billingControl->is_blocked,
                            'block_reason' => $billingControl->block_reason
                        ]
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function syncBilling($email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            $service = new ViewTrackingService();
            
            if ($service->syncBillingRecords($user->id)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cobranças sincronizadas com sucesso'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Erro ao sincronizar cobranças'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function unblockUser($email)
    {
        try {
            DB::beginTransaction();

            $user = User::where('email', $email)->firstOrFail();

            // Limpa registros antigos
            ViewBillingRecord::where('user_id', $user->id)
                ->where('status', 'pending')
                ->delete();

            // Reseta controle de billing
            $billingControl = UserBillingControl::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'pending_amount' => 0,
                    'is_blocked' => false,
                    'block_reason' => null
                ]
            );

            $billingControl->pending_amount = 0;
            $billingControl->is_blocked = false;
            $billingControl->block_reason = null;
            $billingControl->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Usuário desbloqueado com sucesso',
                'billing' => [
                    'pending_amount' => $billingControl->pending_amount,
                    'is_blocked' => $billingControl->is_blocked,
                    'block_reason' => $billingControl->block_reason
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
