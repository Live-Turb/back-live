<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VideoDetail;
use App\Models\ViewBillingRecord;
use App\Models\UserBillingControl;
use App\Services\ViewTrackingService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

class BillingTestController extends Controller
{
    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    public function testBilling($email)
    {
        try {
            DB::beginTransaction();
            
            $user = User::where('email', $email)->firstOrFail();
            
            // Garante que a tabela user_billing_controls existe
            if (!Schema::hasTable('user_billing_controls')) {
                Schema::create('user_billing_controls', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                    $table->string('last_ip')->nullable();
                    $table->string('device_fingerprint')->nullable();
                    $table->decimal('pending_amount', 10, 2)->default(0);
                    $table->boolean('is_blocked')->default(false);
                    $table->text('block_reason')->nullable();
                    $table->timestamp('last_billing_check')->nullable();
                    $table->timestamps();
                });
            }

            $billingControl = UserBillingControl::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'pending_amount' => 0,
                    'is_blocked' => false,
                    'last_ip' => request()->ip(),
                    'device_fingerprint' => md5(request()->userAgent())
                ]
            );

            // Busca informações atuais
            $currentStats = [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'billing_control' => [
                    'pending_amount' => $billingControl->pending_amount,
                    'is_blocked' => $billingControl->is_blocked,
                    'block_reason' => $billingControl->block_reason,
                ],
                'pending_charges' => ViewBillingRecord::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->get()
                    ->map(function($charge) {
                        return [
                            'id' => $charge->id,
                            'extra_views' => $charge->extra_views,
                            'amount' => $charge->extra_views_cost,
                            'created_at' => $charge->created_at->format('Y-m-d H:i:s')
                        ];
                    })
            ];

            // Simula algumas visualizações extras
            $viewsToSimulate = 600; // Simula 600 visualizações (12 reais em visualizações extras)
            
            // Busca um vídeo existente do usuário
            $video = VideoDetail::where('user_id', $user->id)->first();
            
            if (!$video) {
                throw new \Exception('Usuário não possui vídeos para teste. Crie um vídeo primeiro.');
            }

            for ($i = 0; $i < $viewsToSimulate; $i++) {
                $this->viewTrackingService->recordView(
                    $video->id,
                    $user->id,
                    request()
                );
            }

            // Atualiza estatísticas após simulação
            $billingControl->refresh();
            $updatedStats = [
                'billing_control' => [
                    'pending_amount' => $billingControl->pending_amount,
                    'is_blocked' => $billingControl->is_blocked,
                    'block_reason' => $billingControl->block_reason,
                ],
                'pending_charges' => ViewBillingRecord::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->get()
                    ->map(function($charge) {
                        return [
                            'id' => $charge->id,
                            'extra_views' => $charge->extra_views,
                            'amount' => $charge->extra_views_cost,
                            'created_at' => $charge->created_at->format('Y-m-d H:i:s')
                        ];
                    })
            ];

            DB::commit();

            return response()->json([
                'message' => 'Teste de cobrança realizado com sucesso',
                'views_simulated' => $viewsToSimulate,
                'before' => $currentStats,
                'after' => $updatedStats
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * Limpa o histórico de cobranças de um usuário específico
     */
    public function clearBillingHistory()
    {
        try {
            $userEmail = 'antoniojhuliene@gmail.com';
            $user = User::where('email', $userEmail)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não encontrado'
                ]);
            }

            DB::beginTransaction();

            // Remove todos os registros de cobrança do usuário
            ViewBillingRecord::where('user_id', $user->id)->delete();

            // Limpa os caches relacionados
            cache()->forget("views_count_{$user->id}_" . date('Ym'));
            cache()->forget("billing_control_{$user->id}");

            // Reseta o controle de billing
            UserBillingControl::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'pending_amount' => 0,
                    'is_blocked' => false,
                    'block_reason' => null,
                    'last_billing_check' => now()
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Histórico de cobranças limpo com sucesso'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao limpar histórico de cobranças: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erro ao limpar histórico de cobranças'
            ]);
        }
    }
}
