<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Primeiro adicionar o novo campo
        Schema::table('anuncios', function (Blueprint $table) {
            $table->string('link_transcricao')->nullable()->after('transcricao');
        });

        // Depois copiar os dados existentes
        DB::table('anuncios')
            ->whereNotNull('transcricao')
            ->each(function ($anuncio) {
                $url = $anuncio->transcricao;

                // Se for uma URL do MinIO, usar diretamente
                if (strpos($url, 'prod-minio.ja6ipr.easypanel.host') !== false) {
                    DB::table('anuncios')
                        ->where('id', $anuncio->id)
                        ->update(['link_transcricao' => $url]);
                } else {
                    // Para outros casos, usar o Office Online Viewer
                    DB::table('anuncios')
                        ->where('id', $anuncio->id)
                        ->update([
                            'link_transcricao' => 'https://view.officeapps.live.com/op/embed.aspx?src=' . urlencode($url)
                        ]);
                }
            });

        // Por fim, remover o campo antigo
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('transcricao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Recriar campo antigo
            $table->text('transcricao')->nullable();

            // Remover novo campo
            $table->dropColumn('link_transcricao');
        });
    }
};
