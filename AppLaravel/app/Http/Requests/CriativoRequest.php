<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriativoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assumindo que o middleware de admin já verifica a autorização
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'anuncio_id' => 'required|exists:anuncios,id',
            'titulo' => 'nullable|string|max:100',
            'tag' => 'nullable|string|max:50',
            'url' => 'required|url|max:2048',
            'creativeId' => 'nullable|string|max:255',
            'platform' => 'required|array|min:1',
            'platform.*' => 'string|in:Facebook,Instagram,Google,TikTok,YouTube,Outra',
            'language' => 'nullable|string|max:255',
            'idioma' => 'required|string|max:10',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'views' => 'nullable|integer|min:0',
            'caption' => 'nullable|string',
            'status' => 'required|in:ativo,inativo',
            'value' => 'nullable|integer|min:0',
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
            'anuncio_id.required' => 'O anúncio é obrigatório',
            'anuncio_id.exists' => 'O anúncio selecionado não existe',
            'titulo.max' => 'O título não pode ter mais de 100 caracteres',
            'tag.max' => 'A tag não pode ter mais de 50 caracteres',
            'url.required' => 'A URL do criativo é obrigatória',
            'url.url' => 'Por favor, forneça uma URL válida',
            'url.max' => 'A URL não pode ter mais de 2048 caracteres',
            'platform.required' => 'A plataforma é obrigatória',
            'platform.array' => 'A plataforma deve ser um array',
            'platform.min' => 'A plataforma deve ter pelo menos 1 item',
            'platform.*.string' => 'Cada plataforma deve ser uma string',
            'platform.*.in' => 'Cada plataforma deve ser uma das seguintes: Facebook, Instagram, Google, TikTok, YouTube, Outra',
            'language.required' => 'O idioma é obrigatório',
            'idioma.required' => 'O idioma do criativo é obrigatório',
            'image.mimes' => 'Se fornecida, a imagem deve ser do tipo: jpeg, png, jpg, gif',
            'image.max' => 'Se fornecida, a imagem não pode ser maior que 2MB',
            'status.required' => 'O status é obrigatório',
            'status.in' => 'O status deve ser ativo ou inativo',
        ];
    }
}
