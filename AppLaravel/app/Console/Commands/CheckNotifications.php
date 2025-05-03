<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NotificationService;

class CheckNotifications extends Command
{
    protected $signature = 'notifications:check';
    protected $description = 'Verifica e envia notificações de limite de visualizações e pagamentos pendentes';

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function handle()
    {
        $this->info('Iniciando verificação de notificações...');

        // Verifica limites de visualizações
        $this->info('Verificando limites de visualizações...');
        $this->notificationService->checkViewsLimits();

        // Verifica pagamentos pendentes
        $this->info('Verificando pagamentos pendentes...');
        $this->notificationService->checkPendingPayments();

        $this->info('Verificação de notificações concluída!');
    }
}
