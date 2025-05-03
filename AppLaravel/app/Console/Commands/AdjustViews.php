<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\TemplateView;
use App\Models\ViewStatistic;
use App\Models\VideoDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdjustViews extends Command
{
    protected $signature = 'views:adjust {email} {count}';
    protected $description = 'Ajusta o número de visualizações para um usuário';

    public function handle()
    {
        $email = $this->argument('email');
        $count = $this->argument('count');

        try {
            DB::beginTransaction();

            $user = User::where('email', $email)->firstOrFail();
            $this->info("Usuário encontrado: {$user->name}");

            // Limpa visualizações existentes
            $deleted = ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->delete();
            $this->info("Visualizações antigas removidas: {$deleted}");

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
            $this->info("Vídeo encontrado: {$video->id}");

            // Cria novas visualizações
            $views = [];
            $viewStats = [];
            $now = Carbon::now();

            $this->info("Criando {$count} visualizações...");
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
            $this->info("Visualizações ajustadas com sucesso!");

            // Mostra estado atual
            $currentViews = ViewStatistic::where('user_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count();
            
            $this->info("Total de visualizações atual: {$currentViews}");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Erro: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
