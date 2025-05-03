<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anuncio extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'anuncios';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descricao',
        'url_video',
        'link_transcricao',
        'status',
        'categoria_id',
        'user_id',
        'tag_principal',
        'data_anuncio',
        'nicho',
        'pais_codigo',
        'novo_anuncio',
        'destaque',
        'tags',
        'imagem',
        'produto_tipo',
        'produto_estrutura',
        'produto_idioma',
        'produto_rede_trafego',
        'produto_funil_vendas',
        'link_pagina_anuncio',
        'link_criativos_fb',
        'link_anuncios_escalados',
        'link_site_cloaker',
        'variacao_diaria',
        'variacao_semanal',
        'numero_anuncios',
    ];

    /**
     * Os atributos que devem ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_anuncio' => 'date',
        'novo_anuncio' => 'boolean',
        'destaque' => 'boolean',
        'tags' => 'array',
        'numero_anuncios' => 'integer',
        'variacao_diaria' => 'integer',
        'variacao_semanal' => 'integer',
        'numero_criativos' => 'integer',
    ];

    /**
     * Os atributos que são somente leitura.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'numero_criativos',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Obter os criativos associados ao anúncio.
     */
    public function criativos(): HasMany
    {
        return $this->hasMany(Criativo::class);
    }

    /**
     * Atualiza o contador de criativos após salvar ou atualizar o modelo.
     */
    public static function boot()
    {
        parent::boot();

        // Após o anúncio ser recuperado do BD
        static::retrieved(function ($anuncio) {
            $anuncio->atualizaContadorCriativos();
            $anuncio->atualizaNumeroAnuncios();
        });

        // Após o anúncio ser criado
        static::created(function ($anuncio) {
            $anuncio->atualizaContadorCriativos();
            $anuncio->atualizaNumeroAnuncios();
        });

        // Após o anúncio ser atualizado
        static::updated(function ($anuncio) {
            $anuncio->atualizaContadorCriativos();
            $anuncio->atualizaNumeroAnuncios();
        });
    }

    /**
     * Atualiza o contador de criativos vinculados a este anúncio.
     */
    public function atualizaContadorCriativos()
    {
        $contador = $this->criativos()->count();

        if ($this->numero_criativos != $contador) {
            $this->numero_criativos = $contador;
            $this->saveQuietly(); // Salva sem disparar eventos para evitar loop infinito
        }

        return $contador;
    }
    
    /**
     * Atualiza o número de anúncios baseado na soma dos criativos ativos.
     */
    public function atualizaNumeroAnuncios()
    {
        // Obtém todos os criativos ativos
        $criativos = $this->criativos()->where('status', 'ativo')->get();
        
        // Soma o value de todos os criativos ativos
        $total = 0;
        foreach ($criativos as $criativo) {
            $total += (int)$criativo->value;
        }
        
        // Registra o valor anterior para cálculo da variação
        $valorAnterior = $this->numero_anuncios;
        
        // Atualiza o número de anúncios
        if ($this->numero_anuncios != $total) {
            // Calcula a variação diária
            $variacao = $total - $valorAnterior;
            $this->variacao_diaria = $variacao;
            
            // Atualiza a variação semanal (acumula)
            if (is_null($this->variacao_semanal)) {
                $this->variacao_semanal = $variacao;
            } else {
                $this->variacao_semanal += $variacao;
            }
            
            // Atualiza o número de anúncios
            $this->numero_anuncios = $total;
            
            // Log de debug
            \Illuminate\Support\Facades\Log::debug('Atualizando numero_anuncios', [
                'id_anuncio' => $this->id,
                'valor_anterior' => $valorAnterior,
                'novo_valor' => $total,
                'variacao_diaria' => $this->variacao_diaria,
                'variacao_semanal' => $this->variacao_semanal
            ]);
            
            // Salva sem disparar eventos para evitar loop infinito
            $this->saveQuietly();
        }
        
        return $total;
    }

    /**
     * Retorna o valor de numero_anuncios, garantindo que seja inteiro
     */
    public function getNumeroAnunciosAttribute($value)
    {
        // Log para depuração
        \Illuminate\Support\Facades\Log::debug('Acessando numero_anuncios', [
            'valor_original' => $value,
            'tipo' => gettype($value),
            'id_anuncio' => $this->id
        ]);

        // Garantir que o valor seja inteiro
        return (int)$value;
    }

    /**
     * Retorna o URL completo da imagem quando ela existir
     */
    public function getImagemAttribute($value)
    {
        if (!$value) {
            return null;
        }

        // Criar a URL diretamente para a pasta storage
        $baseUrl = url('/');
        $storageUrl = $baseUrl . '/storage_direct/' . $value;

        // Log para depuração
        \Illuminate\Support\Facades\Log::debug('Acessando imagem', [
            'valor_original' => $value,
            'url_gerada' => $storageUrl
        ]);

        return $storageUrl;
    }

    /**
     * Preparar os atributos do modelo para serialização.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        // Garantir que numero_anuncios seja inteiro
        if (isset($array['numero_anuncios'])) {
            $array['numero_anuncios'] = (int)$array['numero_anuncios'];

            // Log do valor na serialização
            \Illuminate\Support\Facades\Log::debug('Serializando anuncio', [
                'id' => $this->id,
                'numero_anuncios' => $array['numero_anuncios'],
                'tipo' => gettype($array['numero_anuncios'])
            ]);
        }

        return $array;
    }
}
