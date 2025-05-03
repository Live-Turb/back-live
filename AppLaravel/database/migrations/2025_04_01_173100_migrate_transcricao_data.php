<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Criar tabela temporária para armazenar transcrições
        Schema::create('temp_transcricoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anuncio_id');
            $table->string('titulo');
            $table->text('conteudo');
            $table->timestamps();
        });

        // Copiar dados existentes
        DB::table('anuncios')
            ->whereNotNull('transcricao')
            ->select('id as anuncio_id', 'titulo', 'transcricao as conteudo')
            ->get()
            ->each(function ($anuncio) {
                DB::table('temp_transcricoes')->insert([
                    'anuncio_id' => $anuncio->anuncio_id,
                    'titulo' => $anuncio->titulo,
                    'conteudo' => $anuncio->conteudo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });

        // Log para verificação
        $count = DB::table('temp_transcricoes')->count();
        Log::info("Copiados {$count} registros para tabela temporária");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_transcricoes');
    }
};
