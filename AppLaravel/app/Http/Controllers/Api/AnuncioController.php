<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class AnuncioController extends Controller
{
    /**
     * Obter lista de anúncios com filtragem
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Log para debug
        Log::debug('Requisição de listagem de anúncios recebida', [
            'params' => $request->all()
        ]);

        // Iniciar query
        $query = Anuncio::query();

        // Filtros
        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where('titulo', 'like', "%{$busca}%");
        }

        if ($request->has('nicho')) {
            $query->where('nicho', $request->input('nicho'));
        }

        if ($request->has('categoria')) {
            $query->where('tag_principal', $request->input('categoria'));
        }

        // Ordenação
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        if (in_array($sortBy, ['titulo', 'created_at', 'data_anuncio', 'status', 'tag_principal'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Contagem de criativos
        $query->withCount('criativos');

        // Paginação
        $perPage = $request->input('per_page', 10);
        $anuncios = $query->paginate($perPage);

        // Processar itens para garantir que numero_anuncios seja inteiro
        $itens = $anuncios->items();
        foreach ($itens as $anuncio) {
            // Força número de anúncios como inteiro
            if ($anuncio->numero_anuncios === null) {
                $anuncio->numero_anuncios = 0;
            } else {
                $anuncio->numero_anuncios = (int)$anuncio->numero_anuncios;
            }

            // Garantir que as tags sejam sempre um array
            if ($anuncio->tags === null) {
                $anuncio->tags = [];
            } else if (is_string($anuncio->tags)) {
                // Se for uma string, tenta converter para array
                try {
                    $tagsArray = json_decode($anuncio->tags, true);
                    if (is_array($tagsArray)) {
                        $anuncio->tags = $tagsArray;
                    } else {
                        $anuncio->tags = [$anuncio->tags];
                    }
                } catch (\Exception $e) {
                    $anuncio->tags = [$anuncio->tags];
                }
            }

            // Log para debug
            Log::debug("Anúncio {$anuncio->id} processado", [
                'titulo' => $anuncio->titulo,
                'numero_anuncios' => $anuncio->numero_anuncios,
                'tipo' => gettype($anuncio->numero_anuncios),
                'tags' => $anuncio->tags,
                'tipo_tags' => gettype($anuncio->tags)
            ]);
        }

        return response()->json([
            'data' => $itens,
            'meta' => [
                'current_page' => $anuncios->currentPage(),
                'last_page' => $anuncios->lastPage(),
                'per_page' => $anuncios->perPage(),
                'total' => $anuncios->total()
            ]
        ]);
    }

    /**
     * Armazenar um novo anúncio
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        // Tratar campo tags antes da validação
        if ($request->has('tags')) {
            $tags = $request->input('tags');

            if (is_string($tags)) {
                // Se for uma string JSON, tenta converter para array
                try {
                    $tagsArray = json_decode($tags, true);
                    if (is_array($tagsArray)) {
                        $dados['tags'] = $tagsArray;
                    } else {
                        // Se não for JSON válido, transforma em array com um único item
                        $dados['tags'] = [$tags];
                    }
                } catch (\Exception $e) {
                    // Em caso de erro, transforma em array com um único item
                    $dados['tags'] = [$tags];
                }
            } elseif (!is_array($tags)) {
                // Se não for nem string nem array, converte para array
                $dados['tags'] = [$tags];
            } else {
                $dados['tags'] = $tags;
            }

            // Log para debug
            Log::debug('Tags pré-processadas antes da validação:', [
                'tags_original' => $request->input('tags'),
                'tags_processadas' => $dados['tags']
            ]);

            // Sobrescreve o request para validação
            $request->merge(['tags' => $dados['tags']]);
        } else {
            // Se não houver tags, define como array vazio
            $dados['tags'] = [];
            $request->merge(['tags' => []]);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'tag_principal' => 'required|in:ESCALANDO,TESTE,PAUSADO',
            'data_anuncio' => 'required|date',
            'nicho' => 'required|string|max:255',
            'pais_codigo' => 'required|string|size:2',
            'status' => 'required|in:Ativo,Inativo',
            'novo_anuncio' => 'boolean',
            'destaque' => 'boolean',
            'tags' => 'nullable',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_video' => 'nullable|url|max:255',
            'link_transcricao' => 'nullable|url|max:255',
            'produto_tipo' => 'required|in:Infoproduto,Produto Físico,Serviço,Assinatura',
            'produto_estrutura' => 'required|in:VSL,PLR,Webinar,Carta de Vendas',
            'produto_idioma' => 'required|string|max:255',
            'produto_rede_trafego' => 'required|string|max:255',
            'produto_funil_vendas' => 'required|string|max:255',
            'link_pagina_anuncio' => 'nullable|url|max:255',
            'link_criativos_fb' => 'nullable|url|max:255',
            'link_anuncios_escalados' => 'nullable|url|max:255',
            'link_site_cloaker' => 'nullable|url|max:255',
            'variacao_diaria' => 'nullable|integer',
            'variacao_semanal' => 'nullable|integer',
            'numero_anuncios' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            Log::debug('Falha na validação:', [
                'errors' => $validator->errors()->toArray()
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Garantir processamento do campo tags depois da validação
        if (isset($dados['tags'])) {
            if (is_string($dados['tags'])) {
                try {
                    $tagsArray = json_decode($dados['tags'], true);
                    if (is_array($tagsArray)) {
                        $dados['tags'] = $tagsArray;
                    } else {
                        $dados['tags'] = [$dados['tags']];
                    }
                } catch (\Exception $e) {
                    $dados['tags'] = [$dados['tags']];
                }
            } elseif (!is_array($dados['tags'])) {
                $dados['tags'] = [$dados['tags']];
            }
        } else {
            $dados['tags'] = [];
        }

        // Log final
        Log::debug('Tags antes da criação do anúncio:', [
            'tags' => $dados['tags'],
            'tipo' => gettype($dados['tags'])
        ]);

        // Tratar upload de imagem
        if ($request->hasFile('imagem')) {
            $caminho = $request->file('imagem')->store('anuncios', 'public');
            $dados['imagem'] = $caminho;
        }

        // Criar anúncio
        $anuncio = Anuncio::create($dados);

        return response()->json($anuncio, 201);
    }

    /**
     * Exibir um anúncio específico com seus criativos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anuncio = Anuncio::with('criativos')->findOrFail($id);

        // Garantir que numero_anuncios seja inteiro
        if ($anuncio->numero_anuncios === null) {
            $anuncio->numero_anuncios = 0;
        } else {
            $anuncio->numero_anuncios = (int)$anuncio->numero_anuncios;
        }

        // Garantir que as tags sejam sempre um array
        if ($anuncio->tags === null) {
            $anuncio->tags = [];
        } else if (is_string($anuncio->tags)) {
            // Se for uma string, tenta converter para array
            try {
                $tagsArray = json_decode($anuncio->tags, true);
                if (is_array($tagsArray)) {
                    $anuncio->tags = $tagsArray;
                } else {
                    $anuncio->tags = [$anuncio->tags];
                }
            } catch (\Exception $e) {
                $anuncio->tags = [$anuncio->tags];
            }
        }

        // Log para debug
        Log::debug("Anúncio {$anuncio->id} detalhado via API", [
            'titulo' => $anuncio->titulo,
            'numero_anuncios' => $anuncio->numero_anuncios,
            'tipo' => gettype($anuncio->numero_anuncios),
            'tags' => $anuncio->tags,
            'tipo_tags' => gettype($anuncio->tags)
        ]);

        return response()->json($anuncio);
    }

    /**
     * Atualizar um anúncio
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $anuncio = Anuncio::findOrFail($id);

        $dados = $request->all();

        // Tratar campo tags antes da validação
        if ($request->has('tags')) {
            $tags = $request->input('tags');

            if (is_string($tags)) {
                // Se for uma string JSON, tenta converter para array
                try {
                    $tagsArray = json_decode($tags, true);
                    if (is_array($tagsArray)) {
                        $dados['tags'] = $tagsArray;
                    } else {
                        // Se não for JSON válido, transforma em array com um único item
                        $dados['tags'] = [$tags];
                    }
                } catch (\Exception $e) {
                    // Em caso de erro, transforma em array com um único item
                    $dados['tags'] = [$tags];
                }
            } elseif (!is_array($tags)) {
                // Se não for nem string nem array, converte para array
                $dados['tags'] = [$tags];
            } else {
                $dados['tags'] = $tags;
            }

            // Log para debug
            Log::debug('Tags pré-processadas antes da validação (update):', [
                'tags_original' => $request->input('tags'),
                'tags_processadas' => $dados['tags']
            ]);

            // Sobrescreve o request para validação
            $request->merge(['tags' => $dados['tags']]);
        } else {
            // Se não houver tags, define como array vazio
            $dados['tags'] = [];
            $request->merge(['tags' => []]);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'tag_principal' => 'required|in:ESCALANDO,TESTE,PAUSADO',
            'data_anuncio' => 'required|date',
            'nicho' => 'required|string|max:255',
            'pais_codigo' => 'required|string|size:2',
            'status' => 'required|in:Ativo,Inativo',
            'novo_anuncio' => 'boolean',
            'destaque' => 'boolean',
            'tags' => 'nullable',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_video' => 'nullable|url|max:255',
            'link_transcricao' => 'nullable|url|max:255',
            'produto_tipo' => 'required|in:Infoproduto,Produto Físico,Serviço,Assinatura',
            'produto_estrutura' => 'required|in:VSL,PLR,Webinar,Carta de Vendas',
            'produto_idioma' => 'required|string|max:255',
            'produto_rede_trafego' => 'required|string|max:255',
            'produto_funil_vendas' => 'required|string|max:255',
            'link_pagina_anuncio' => 'nullable|url|max:255',
            'link_criativos_fb' => 'nullable|url|max:255',
            'link_anuncios_escalados' => 'nullable|url|max:255',
            'link_site_cloaker' => 'nullable|url|max:255',
            'variacao_diaria' => 'nullable|integer',
            'variacao_semanal' => 'nullable|integer',
            'numero_anuncios' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Garantir processamento do campo tags depois da validação
        if (isset($dados['tags'])) {
            if (is_string($dados['tags'])) {
                try {
                    $tagsArray = json_decode($dados['tags'], true);
                    if (is_array($tagsArray)) {
                        $dados['tags'] = $tagsArray;
                    } else {
                        $dados['tags'] = [$dados['tags']];
                    }
                } catch (\Exception $e) {
                    $dados['tags'] = [$dados['tags']];
                }
            } elseif (!is_array($dados['tags'])) {
                $dados['tags'] = [$dados['tags']];
            }
        } else {
            $dados['tags'] = [];
        }

        // Log final
        Log::debug('Tags antes da atualização do anúncio:', [
            'id' => $id,
            'tags' => $dados['tags'],
            'tipo' => gettype($dados['tags'])
        ]);

        // Tratar upload de imagem
        if ($request->hasFile('imagem')) {
            // Remover imagem anterior se existir
            if ($anuncio->imagem) {
                Storage::disk('public')->delete($anuncio->imagem);
            }

            $caminho = $request->file('imagem')->store('anuncios', 'public');
            $dados['imagem'] = $caminho;
        }

        // Atualizar anúncio
        $anuncio->update($dados);

        return response()->json($anuncio);
    }

    /**
     * Remover um anúncio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);

        // Soft delete do anúncio (criativos serão excluídos pela relação onDelete cascade)
        $anuncio->delete();

        return response()->json(null, 204);
    }
}
