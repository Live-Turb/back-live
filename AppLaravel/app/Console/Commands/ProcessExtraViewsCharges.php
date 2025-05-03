<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ViewBillingService;

class ProcessExtraViewsCharges extends Command
{
    protected $signature = 'views:process-charges';
    protected $description = 'Processa as cobranças extras de visualizações pendentes';

    protected $billingService;

    public function __construct(ViewBillingService $billingService)
    {
        parent::__construct();
        $this->billingService = $billingService;
    }

    public function handle()
    {
        $this->info('Iniciando processamento de cobranças extras...');

        try {
            $this->billingService->processExtraViewsCharges();
            $this->info('Processamento concluído com sucesso!');
        } catch (\Exception $e) {
            $this->error('Erro ao processar cobranças: ' . $e->getMessage());
        }
    }
}
