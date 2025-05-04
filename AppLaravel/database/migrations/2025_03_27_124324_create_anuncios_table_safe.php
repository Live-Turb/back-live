<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verifica se a tabela já existe antes de tentar criá-la
        if (!Schema::hasTable('anuncios')) {
            Schema::create('anuncios', function (Blueprint $table) {
                $table->id();
                $table->string('titulo');
                $table->string('tag_principal', 50)->nullable();
                $table->date('data_anuncio');
                $table->string('nicho');
                $table->string('pais_codigo', 2);
                $table->enum('status', ['Ativo', 'Inativo']);
                $table->boolean('novo_anuncio')->default(false);
                $table->boolean('destaque')->default(false);
                $table->json('tags')->nullable();
                $table->string('imagem')->nullable();
                $table->string('url_video')->nullable();
                $table->text('transcricao')->nullable();

                // Campos de Produto
                $table->enum('produto_tipo', ['Infoproduto', 'Produto Físico', 'Serviço', 'Assinatura']);
                $table->enum('produto_estrutura', ['VSL', 'PLR', 'Webinar', 'Carta de Vendas']);
                $table->string('produto_idioma');
                $table->string('produto_rede_trafego');
                $table->string('produto_funil_vendas');

                // Campos de Link
                $table->string('link_pagina_anuncio')->nullable();
                $table->string('link_criativos_fb')->nullable();
                $table->string('link_anuncios_escalados')->nullable();
                $table->string('link_site_cloaker')->nullable();

                // Campos Calculados
                $table->integer('contador_anuncios')->default(0);
                $table->integer('variacao_diaria')->default(0)->comment('Número absoluto de anúncios nas últimas 24h');
                $table->integer('variacao_semanal')->default(0)->comment('Número absoluto de anúncios nos últimos 7 dias');

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não removemos a tabela aqui, pois outras migrações podem depender dela
    }
};
