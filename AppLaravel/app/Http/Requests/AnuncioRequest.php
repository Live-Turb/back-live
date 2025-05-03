<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class AnuncioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assumindo que o middleware de admin já verifica a autorização
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('tags')) {
            $tags = $this->tags;

            // Se for uma string não vazia, converter para array
            if (is_string($tags) && !empty($tags)) {
                // Separar por vírgula e remover espaços em branco
                $tagsArray = array_map('trim', explode(',', $tags));
                // Filtrar valores vazios
                $tagsArray = array_filter($tagsArray, 'strlen');

                // Log para debug
                Log::debug('Convertendo tags de string para array', [
                    'original' => $tags,
                    'convertido' => $tagsArray
                ]);

                $this->merge(['tags' => $tagsArray]);
            } elseif (empty($tags)) {
                // Se for vazio, definir como array vazio
                $this->merge(['tags' => []]);
            }
        } else {
            // Se não existir, criar como array vazio
            $this->merge(['tags' => []]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'tag_principal' => 'required|in:ESCALANDO,TESTE,PAUSADO,RECEM ADICIONADO,EVOLUINDO RAPIDO,OPORTUNIDADE RAPIDA,ATIVA',
            'data_anuncio' => 'required|date',
            'nicho' => 'required|string|max:255',
            'pais_codigo' => 'required|string|size:2',
            'status' => 'required|in:Ativo,Inativo',
            'novo_anuncio' => 'boolean',
            'destaque' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_video' => 'nullable|url',
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
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório',
            'tag_principal.required' => 'A tag principal é obrigatória',
            'tag_principal.in' => 'A tag principal deve ser ESCALANDO, TESTE, PAUSADO, RECEM ADICIONADO, EVOLUINDO RAPIDO, OPORTUNIDADE RAPIDA ou ATIVA',
            'data_anuncio.required' => 'A data do anúncio é obrigatória',
            'data_anuncio.date' => 'A data do anúncio deve ser uma data válida',
            'nicho.required' => 'O nicho é obrigatório',
            'pais_codigo.required' => 'O código do país é obrigatório',
            'pais_codigo.size' => 'O código do país deve ter 2 caracteres',
            'status.required' => 'O status é obrigatório',
            'status.in' => 'O status deve ser Ativo ou Inativo',
            'imagem.image' => 'O arquivo deve ser uma imagem',
            'imagem.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif',
            'imagem.max' => 'A imagem não pode ser maior que 2MB',
            'url_video.url' => 'A URL do vídeo deve ser válida',
            'link_transcricao.url' => 'O link da transcrição deve ser uma URL válida',
            'produto_tipo.required' => 'O tipo de produto é obrigatório',
            'produto_tipo.in' => 'O tipo de produto deve ser Infoproduto, Produto Físico, Serviço ou Assinatura',
            'produto_estrutura.required' => 'A estrutura do produto é obrigatória',
            'produto_estrutura.in' => 'A estrutura do produto deve ser VSL, PLR, Webinar ou Carta de Vendas',
            'produto_idioma.required' => 'O idioma do produto é obrigatório',
            'produto_rede_trafego.required' => 'A rede de tráfego é obrigatória',
            'produto_funil_vendas.required' => 'O funil de vendas é obrigatório',
            'link_pagina_anuncio.url' => 'O link da página de anúncio deve ser uma URL válida',
            'link_criativos_fb.url' => 'O link dos criativos do Facebook deve ser uma URL válida',
            'link_anuncios_escalados.url' => 'O link dos anúncios escalados deve ser uma URL válida',
            'link_site_cloaker.url' => 'O link do site cloaker deve ser uma URL válida',
            'variacao_diaria.integer' => 'A variação diária deve ser um número inteiro',
            'variacao_semanal.integer' => 'A variação semanal deve ser um número inteiro',
            'numero_anuncios.integer' => 'O número de anúncios deve ser um número inteiro',
            'numero_anuncios.min' => 'O número de anúncios não pode ser negativo',
            'tags.array' => 'O campo tags deve ser um array.',
        ];
    }
}
