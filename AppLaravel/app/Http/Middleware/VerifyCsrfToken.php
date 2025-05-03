<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'views/test-billing',
        'mercadopago/webhook',
        'generate/comment/ajax', // Excluímos esta rota do CSRF
        'views/adjust', // Rota de teste - remover em produção
    ];
}
