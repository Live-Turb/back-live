<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnuncioController extends Controller
{
    public function edit($id)
    {
        $anuncio = Anuncio::with('criativos')->findOrFail($id);

        // Log para debug do valor de numero_anuncios
        Log::debug("Valor de numero_anuncios na edição do anúncio {$id}", [
            'valor' => $anuncio->numero_anuncios,
            'tipo' => gettype($anuncio->numero_anuncios),
            'valor_raw' => $anuncio->getOriginal('numero_anuncios'),
            'tipo_raw' => gettype($anuncio->getOriginal('numero_anuncios'))
        ]);

        return view('admin.anuncios.edit', compact('anuncio'));
    }

    public function update(Request $request, $id)
    {
        // Processamento de tags
        if ($request->has('tags')) {
            $tags = $request->input('tags');

            // Se for uma string, converter para array
            if (is_string($tags) && !empty($tags)) {
                // Separar por vírgula e remover espaços em branco
                $tagsArray = array_map('trim', explode(',', $tags));
                // Filtrar valores vazios
                $tagsArray = array_filter($tagsArray, 'strlen');
                $request->merge(['tags' => $tagsArray]);
            } elseif (is_null($tags) || $tags === '') {
                $request->merge(['tags' => []]);
            }
        } else {
            $request->merge(['tags' => []]);
        }

        // Ensure the value is an integer
        $request->merge(['numero_anuncios' => (int)$request->input('numero_anuncios')]);

        // Log de debug
        Log::debug('Atualizando anúncio', [
            'id' => $id,
            'tags' => $request->input('tags'),
            'tipo_tags' => gettype($request->input('tags')),
            'numero_anuncios' => $request->input('numero_anuncios'),
            'tipo_numero_anuncios' => gettype($request->input('numero_anuncios'))
        ]);

        // Proceed with the update
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->update($request->all());

        return redirect()->route('admin.anuncios.index')->with('success', 'Anúncio atualizado com sucesso!');
    }

    public function store(Request $request)
    {
        // Processamento de tags
        if ($request->has('tags')) {
            $tags = $request->input('tags');

            // Se for uma string, converter para array
            if (is_string($tags) && !empty($tags)) {
                // Separar por vírgula e remover espaços em branco
                $tagsArray = array_map('trim', explode(',', $tags));
                // Filtrar valores vazios
                $tagsArray = array_filter($tagsArray, 'strlen');
                $request->merge(['tags' => $tagsArray]);
            } elseif (is_null($tags) || $tags === '') {
                $request->merge(['tags' => []]);
            }
        } else {
            $request->merge(['tags' => []]);
        }

        // Ensure the value is an integer
        $request->merge(['numero_anuncios' => (int)$request->input('numero_anuncios', 0)]);

        // Validação e outras lógicas...

        // Log de debug
        Log::debug('Criando anúncio', [
            'tags' => $request->input('tags'),
            'tipo_tags' => gettype($request->input('tags')),
            'numero_anuncios' => $request->input('numero_anuncios'),
            'tipo_numero_anuncios' => gettype($request->input('numero_anuncios'))
        ]);

        // Criar o anúncio
        $anuncio = Anuncio::create($request->all());

        return redirect()->route('admin.anuncios.index')->with('success', 'Anúncio criado com sucesso!');
    }
}
