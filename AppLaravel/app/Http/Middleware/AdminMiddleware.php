<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar se o usuário está autenticado e é um administrador
        if (Auth::check() && Auth::user()->name === 'admin') {
            return $next($request);
        }

        // Redirecionar para a página inicial se não for admin
        return redirect('/')->with('error', 'Acesso não autorizado.');
    }
}
