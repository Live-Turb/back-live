<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Criativo;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CriativoController extends Controller
{
    /**
     * Obter lista de criativos com filtragem
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Criativo::query();

        // Relacionar com anúncio
        $query->with('anuncio:id,titulo,tag_principal,status');

        // Filtros
        if ($request->filled('anuncio_id')) {
            $query->where('anuncio_id', $request->anuncio_id);
        }

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->filled('tag')) {
            $query->where('tag', 'like', '%' . $request->tag . '%');
        }

        if ($request->filled('platform')) {
            $query->where('platform', $request->platform);
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        if ($request->filled('idioma')) {
            $query->where('idioma', $request->idioma);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ordenação
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        if (in_array($sortBy, ['titulo', 'created_at', 'status', 'platform', 'views'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Paginação
        $perPage = $request->input('per_page', 10);
        $criativos = $query->paginate($perPage);

        return response()->json([
            'data' => $criativos->items(),
            'meta' => [
                'current_page' => $criativos->currentPage(),
                'last_page' => $criativos->lastPage(),
                'per_page' => $criativos->perPage(),
                'total' => $criativos->total()
            ]
        ]);
    }

    /**
     * Armazenar um novo criativo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anuncio_id' => 'required|exists:anuncios,id',
            'titulo' => 'required|string|max:100',
            'tag' => 'nullable|string|max:50',
            'url' => 'required|url|max:2048',
            'creativeId' => 'nullable|string|max:255',
            'platform' => 'required|string|max:50',
            'language' => 'required|string|max:50',
            'idioma' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'views' => 'nullable|integer',
            'caption' => 'nullable|string|max:500',
            'status' => 'required|in:Ativo,Inativo,Pendente',
            'value' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar se o anúncio existe
        $anuncio = Anuncio::findOrFail($request->anuncio_id);

        $dados = $request->all();

        // Tratar upload de imagem
        if ($request->hasFile('image')) {
            $caminho = $request->file('image')->store('criativos', 'public');
            $dados['image'] = $caminho;
        }

        // Criar criativo
        $criativo = Criativo::create($dados);

        // Atualizar contagem de criativos no anúncio
        $anuncio->increment('numero_criativos');

        return response()->json($criativo, 201);
    }

    /**
     * Exibir um criativo específico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $criativo = Criativo::with('anuncio:id,titulo,tag_principal,status')->findOrFail($id);

        return response()->json($criativo);
    }

    /**
     * Atualizar um criativo
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $criativo = Criativo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'anuncio_id' => 'exists:anuncios,id',
            'titulo' => 'string|max:100',
            'tag' => 'nullable|string|max:50',
            'url' => 'url|max:2048',
            'creativeId' => 'nullable|string|max:255',
            'platform' => 'string|max:50',
            'language' => 'string|max:50',
            'idioma' => 'string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'views' => 'nullable|integer',
            'caption' => 'nullable|string|max:500',
            'status' => 'in:Ativo,Inativo,Pendente',
            'value' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dados = $request->all();

        // Tratar upload de imagem
        if ($request->hasFile('image')) {
            // Remover imagem anterior se existir
            if ($criativo->image) {
                Storage::disk('public')->delete($criativo->image);
            }

            $caminho = $request->file('image')->store('criativos', 'public');
            $dados['image'] = $caminho;
        }

        // Verificar mudança de anúncio
        $anuncioAnteriorId = $criativo->anuncio_id;

        // Atualizar criativo
        $criativo->update($dados);

        // Se mudou de anúncio, atualizar contagens
        if (isset($dados['anuncio_id']) && $dados['anuncio_id'] != $anuncioAnteriorId) {
            // Decrementar contagem no anúncio anterior
            Anuncio::find($anuncioAnteriorId)?->decrement('numero_criativos');

            // Incrementar contagem no novo anúncio
            Anuncio::find($dados['anuncio_id'])?->increment('numero_criativos');
        }

        return response()->json($criativo);
    }

    /**
     * Remover um criativo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $criativo = Criativo::findOrFail($id);

        // Decrementar contagem no anúncio
        Anuncio::find($criativo->anuncio_id)?->decrement('numero_criativos');

        // Remover imagem se existir
        if ($criativo->image) {
            Storage::disk('public')->delete($criativo->image);
        }

        // Excluir criativo
        $criativo->delete();

        return response()->json(null, 204);
    }
}
