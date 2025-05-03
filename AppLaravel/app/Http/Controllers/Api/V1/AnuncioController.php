<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AnuncioController extends Controller
{
    /**
     * Listar anúncios com filtros e paginação
     */
    public function index(Request $request)
    {
        $query = Anuncio::with('criativos');

        // Aplicar filtros
        if ($request->has('tag_principal')) {
            $query->where('tag_principal', $request->tag_principal);
        }

        if ($request->has('nicho')) {
            $query->where('nicho', 'like', "%{$request->nicho}%");
        }

        if ($request->has('search')) {
            $query->where('titulo', 'like', "%{$request->search}%");
        }

        // Paginação
        $perPage = $request->input('per_page', 10);
        $anuncios = $query->paginate($perPage);

        // Transformar dados para o formato esperado pelo frontend
        $anunciosTransformados = [];
        foreach ($anuncios->items() as $anuncio) {
            $anunciosTransformados[] = [
                'id' => $anuncio->id,
                'titulo' => $anuncio->titulo,
                'tag_principal' => $anuncio->tag_principal,
                'data_anuncio' => $anuncio->data_anuncio->format('Y-m-d'),
                'nicho' => $anuncio->nicho,
                'status' => $anuncio->status,
                'url_video' => $anuncio->url_video,
                'imagem' => $anuncio->imagem,
                'link_transcricao' => $anuncio->link_transcricao,
                'numero_anuncios' => $anuncio->numero_anuncios ?? 0,
                'pais_codigo' => $anuncio->pais_codigo,
                'variacao_diaria' => $anuncio->variacao_diaria,
                'variacao_semanal' => $anuncio->variacao_semanal,
                'novo_anuncio' => (bool)$anuncio->novo_anuncio,
                'tags' => is_array($anuncio->tags) ? $anuncio->tags : [],
                'links' => [
                    'pagina_anuncio' => $anuncio->link_pagina_anuncio,
                    'criativos_fb' => $anuncio->link_criativos_fb,
                    'anuncios_escalados' => $anuncio->link_anuncios_escalados,
                    'site_cloaker' => $anuncio->link_site_cloaker,
                ],
                'produto' => [
                    'tipo' => $anuncio->produto_tipo,
                    'estrutura' => $anuncio->produto_estrutura,
                    'idioma' => $anuncio->produto_idioma,
                    'rede_trafego' => $anuncio->produto_rede_trafego,
                    'funil_vendas' => $anuncio->produto_funil_vendas,
                ],
                'criativos' => $this->transformarCriativos($anuncio->criativos),
                'estatisticas' => $this->gerarEstatisticas($anuncio),
                'creativesPerformance' => $this->gerarPerformanceCriativos($anuncio),
            ];
        }

        return response()->json([
            'data' => $anunciosTransformados,
            'meta' => [
                'current_page' => $anuncios->currentPage(),
                'last_page' => $anuncios->lastPage(),
                'per_page' => $anuncios->perPage(),
                'total' => $anuncios->total()
            ]
        ]);
    }

    /**
     * Exibir um anúncio específico
     */
    public function show($id)
    {
        $anuncio = Anuncio::with('criativos')->findOrFail($id);

        // Transformar para o formato esperado pelo frontend
        $anuncioTransformado = [
            'id' => $anuncio->id,
            'titulo' => $anuncio->titulo,
            'tag_principal' => $anuncio->tag_principal,
            'data_anuncio' => $anuncio->data_anuncio->format('Y-m-d'),
            'nicho' => $anuncio->nicho,
            'status' => $anuncio->status,
            'url_video' => $anuncio->url_video,
            'imagem' => $anuncio->imagem,
            'link_transcricao' => $anuncio->link_transcricao,
            'numero_anuncios' => $anuncio->numero_anuncios ?? 0,
            'pais_codigo' => $anuncio->pais_codigo,
            'variacao_diaria' => $anuncio->variacao_diaria,
            'variacao_semanal' => $anuncio->variacao_semanal,
            'novo_anuncio' => (bool)$anuncio->novo_anuncio,
            'tags' => is_array($anuncio->tags) ? $anuncio->tags : [],
            'links' => [
                'pagina_anuncio' => $anuncio->link_pagina_anuncio,
                'criativos_fb' => $anuncio->link_criativos_fb,
                'anuncios_escalados' => $anuncio->link_anuncios_escalados,
                'site_cloaker' => $anuncio->link_site_cloaker,
            ],
            'produto' => [
                'tipo' => $anuncio->produto_tipo,
                'estrutura' => $anuncio->produto_estrutura,
                'idioma' => $anuncio->produto_idioma,
                'rede_trafego' => $anuncio->produto_rede_trafego,
                'funil_vendas' => $anuncio->produto_funil_vendas,
            ],
            'criativos' => $this->transformarCriativos($anuncio->criativos),
            'estatisticas' => $this->gerarEstatisticas($anuncio),
            'creativesPerformance' => $this->gerarPerformanceCriativos($anuncio),
        ];

        return response()->json(['data' => $anuncioTransformado]);
    }

    /**
     * Transformar criativos para o formato adequado
     */
    private function transformarCriativos($criativos)
    {
        $resultado = [];
        foreach ($criativos as $criativo) {
            $resultado[] = [
                'id' => $criativo->id,
                'title' => $criativo->titulo ?? $criativo->title,
                'creativeId' => $criativo->creativeId,
                'platform' => $criativo->platform,
                'language' => $criativo->language,
                'image' => $criativo->image,
                'views' => $criativo->views,
                'status' => $criativo->status,
                'value' => (float)($criativo->value ?? 0),
                'caption' => $criativo->caption,
                'url' => $criativo->url,
            ];
        }
        return $resultado;
    }

    /**
     * Gerar estatísticas para o anúncio
     * Nota: Esta é uma simulação, idealmente você teria dados reais
     */
    private function gerarEstatisticas($anuncio)
    {
        $hoje = now();
        $estatisticas = [
            '7days' => [],
            '15days' => [],
            '30days' => []
        ];

        // Gerar últimos 7 dias
        for ($i = 6; $i >= 0; $i--) {
            $data = $hoje->copy()->subDays($i);
            $estatisticas['7days'][] = [
                'day' => $data->format('D'),
                'date' => $data->format('Y-m-d'),
                'value' => rand(100, 500)
            ];
        }

        // Gerar últimos 15 dias
        for ($i = 14; $i >= 0; $i--) {
            $data = $hoje->copy()->subDays($i);
            $estatisticas['15days'][] = [
                'day' => $data->format('D'),
                'date' => $data->format('Y-m-d'),
                'value' => rand(100, 500)
            ];
        }

        // Gerar últimos 30 dias
        for ($i = 29; $i >= 0; $i--) {
            $data = $hoje->copy()->subDays($i);
            $estatisticas['30days'][] = [
                'day' => $data->format('D'),
                'date' => $data->format('Y-m-d'),
                'value' => rand(100, 500)
            ];
        }

        return $estatisticas;
    }

    /**
     * Gerar dados de performance de criativos
     */
    private function gerarPerformanceCriativos($anuncio)
    {
        $criativos = $anuncio->criativos;
        $performance = [];

        foreach ($criativos as $index => $criativo) {
            $status = ['growing', 'stable', 'declining'][rand(0, 2)];
            $color = [
                'growing' => '#4CAF50',
                'stable' => '#2196F3',
                'declining' => '#F44336'
            ][$status];

            $performance[] = [
                'name' => $criativo->titulo ?? $criativo->title ?? "Criativo #" . ($index + 1),
                'value' => rand(10, 100),
                'status' => $status,
                'color' => $color
            ];
        }

        return $performance;
    }
}
