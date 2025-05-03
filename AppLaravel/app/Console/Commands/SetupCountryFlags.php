<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Intl\Countries;

class SetupCountryFlags extends Command
{
    protected $signature = 'setup:country-flags';
    protected $description = 'Setup country flags for analytics';

    public function handle()
    {
        $this->info('Configurando bandeiras dos países...');

        // Criar diretórios necessários
        $storageDir = storage_path('app/public/bandeiras_mundo');
        
        if (!File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
            $this->info("Diretório criado: {$storageDir}");
        }

        // Obter lista completa de países
        $countries = Countries::getNames('pt');
        $total = count($countries);
        $current = 0;
        $downloaded = 0;
        $errors = [];

        $this->info("Total de países a processar: {$total}");
        $this->newLine();
        $this->output->progressStart($total);

        // Baixar bandeiras do repositório do Flagpedia
        foreach ($countries as $code => $name) {
            $current++;
            $flagPath = $storageDir . '/' . strtolower($code) . '.png';

            // Pular se a bandeira já existe
            if (File::exists($flagPath)) {
                $this->output->progressAdvance();
                continue;
            }

            try {
                // Tentar primeiro do flagcdn.com
                $flagUrl = "https://flagcdn.com/w640/" . strtolower($code) . ".png";
                $response = Http::timeout(30)->get($flagUrl);
                
                if ($response->successful()) {
                    File::put($flagPath, $response->body());
                    $downloaded++;
                } else {
                    // Se falhar, tentar do flagpedia.net
                    $flagUrl = "https://flagpedia.net/data/flags/w580/" . strtolower($code) . ".png";
                    $response = Http::timeout(30)->get($flagUrl);
                    
                    if ($response->successful()) {
                        File::put($flagPath, $response->body());
                        $downloaded++;
                    } else {
                        $errors[] = "Erro ao baixar bandeira para {$name} ({$code})";
                    }
                }
            } catch (\Exception $e) {
                $errors[] = "Erro ao processar {$name} ({$code}): " . $e->getMessage();
            }

            $this->output->progressAdvance();

            // Pequena pausa para não sobrecarregar o servidor
            if ($current % 5 === 0) {
                usleep(500000); // 0.5 segundos
            }
        }

        $this->output->progressFinish();
        $this->newLine(2);

        // Criar link simbólico se não existir
        if (!File::exists(public_path('storage'))) {
            $this->call('storage:link');
        }

        // Relatório final
        $this->info('=== Relatório Final ===');
        $this->info("Total de países processados: {$total}");
        $this->info("Bandeiras baixadas com sucesso: {$downloaded}");
        $this->info("Bandeiras salvas em: {$storageDir}");
        
        if (count($errors) > 0) {
            $this->newLine();
            $this->warn('Erros encontrados:');
            foreach ($errors as $error) {
                $this->error($error);
            }
        }

        $this->newLine();
        $this->info('Configuração das bandeiras concluída!');
    }
}
