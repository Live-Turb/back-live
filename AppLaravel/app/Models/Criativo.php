<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Criativo extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'criativos';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'anuncio_id',
        'titulo',
        'tag',
        'url',
        'creativeId',
        'platform',
        'language',
        'idioma',
        'image',
        'caption',
        'status',
        'value',
        'performance_status',
        'created_at',
        'updated_at',
        'last_status_change'
    ];

    /**
     * Os atributos que são somente leitura.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_status_change' => 'datetime',
        'platform' => 'array',
    ];

    /**
     * Obter o anúncio associado ao criativo.
     */
    public function anuncio(): BelongsTo
    {
        return $this->belongsTo(Anuncio::class);
    }

    /**
     * Atualiza o contador de criativos do anúncio associado após salvar, atualizar ou excluir o modelo.
     */
    public static function boot()
    {
        parent::boot();

        // Após o criativo ser criado
        static::created(function ($criativo) {
            if ($criativo->anuncio) {
                $criativo->anuncio->atualizaContadorCriativos();
                // Atualiza o número de anúncios com base nos criativos ativos
                $criativo->anuncio->atualizaNumeroAnuncios();
            }
        });

        // Após o criativo ser atualizado
        static::updated(function ($criativo) {
            if ($criativo->anuncio) {
                $criativo->anuncio->atualizaContadorCriativos();
                // Atualiza o número de anúncios com base nos criativos ativos
                $criativo->anuncio->atualizaNumeroAnuncios();
            }
        });

        // Após o criativo ser excluído
        static::deleted(function ($criativo) {
            if ($criativo->anuncio) {
                $criativo->anuncio->atualizaContadorCriativos();
                // Atualiza o número de anúncios com base nos criativos ativos
                $criativo->anuncio->atualizaNumeroAnuncios();
            }
        });

        // Após o criativo ser restaurado (soft delete)
        static::restored(function ($criativo) {
            if ($criativo->anuncio) {
                $criativo->anuncio->atualizaContadorCriativos();
                // Atualiza o número de anúncios com base nos criativos ativos
                $criativo->anuncio->atualizaNumeroAnuncios();
            }
        });
    }

    /**
     * Retorna o URL completo da imagem quando ela existir
     */
    public function getImageAttribute($value)
    {
        if (!$value) {
            return null;
        }

        // Criar a URL diretamente para a pasta storage
        $baseUrl = url('/');
        $storageUrl = $baseUrl . '/storage_direct/' . $value;

        // Log para depuração
        \Illuminate\Support\Facades\Log::debug('Acessando imagem do criativo', [
            'valor_original' => $value,
            'url_gerada' => $storageUrl
        ]);

        return $storageUrl;
    }

    /**
     * Calcula o status de performance do criativo baseado no número de criativos
     * e na quantidade de novos criativos
     *
     * @return string
     */
    public function calculatePerformanceStatus($totalCriativos, $novosCriativos = 0)
    {
        // Status fixo baseado na quantidade de criativos e se estão ativos ou inativos
        if ($this->status == 'inativo') {
            return 'Inativo';
        } else {
            return 'Ativo';
        }
    }

    /**
     * Determina se o criativo está ativo baseado no seu status
     * 
     * @return bool
     */
    public function isAtivo()
    {
        // Com o novo ENUM, podemos verificar diretamente
        return $this->status == 'ativo';
    }

    /**
     * Conta o número de novos criativos (criados nos últimos 7 dias)
     */
    public static function countNovosCriativos($anuncioId)
    {
        return self::where('anuncio_id', $anuncioId)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();
    }
}
