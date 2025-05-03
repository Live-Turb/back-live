<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Verifica o status do usuário
        $user = Auth::user();
        if ($user->status !== 'active' && $user->status !== 'pending') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Sua conta está inativa. Entre em contato com o suporte.');
        }

        return $next($request);
    }
}
