<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessTranscricoes extends Command
{
    protected $signature = 'transcricoes:processar';
    protected $description = 'Processa as transcrições existentes e gera links para visualização';

    public function handle()
    {
        $this->info('Iniciando processamento das transcrições...');

        // Buscar transcrições da tabela temporária
        $transcricoes = DB::table('temp_transcricoes')->get();
        $this->info("Encontradas {$transcricoes->count()} transcrições para processar");

        foreach ($transcricoes as $transcricao) {
            try {
                // Gerar nome único para o arquivo
                $fileName = 'transcricoes/' . Str::slug($transcricao->titulo) . '_' . $transcricao->id . '.docx';

                // Salvar conteúdo como arquivo Word
                Storage::put($fileName, $transcricao->conteudo);

                // Gerar URL pública
                $url = Storage::url($fileName);

                // Atualizar anúncio com o novo link
                DB::table('anuncios')
                    ->where('id', $transcricao->anuncio_id)
                    ->update(['link_transcricao' => $url]);

                $this->info("Processada transcrição ID: {$transcricao->id}");
            } catch (\Exception $e) {
                $this->error("Erro ao processar transcrição ID: {$transcricao->id}");
                $this->error($e->getMessage());
            }
        }

        $this->info('Processamento concluído!');
    }
}
