<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ValidateRecaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o token do reCAPTCHA está presente
        if (!$request->has('g-recaptcha-response')) {
            return back()->withErrors(['recaptcha' => 'Por favor, verifique o reCAPTCHA.'])->withInput();
        }

        // Obtém o token da resposta do reCAPTCHA
        $recaptchaResponse = $request->input('g-recaptcha-response');

        // Verifica se o token é válido através da API do Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip()
        ]);

        // Se a resposta da verificação do reCAPTCHA for bem-sucedida
        if ($response->json('success')) {
            return $next($request);
        }

        // Retorna com erro se a verificação falhar
        return back()->withErrors(['recaptcha' => 'Falha na verificação do reCAPTCHA. Por favor, tente novamente.'])->withInput();
    }
}
