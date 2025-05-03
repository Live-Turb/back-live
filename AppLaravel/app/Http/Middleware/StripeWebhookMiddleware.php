<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Support\Facades\Log;

class StripeWebhookMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('stripe-signature')) {
            Log::warning('Tentativa de acesso ao webhook sem assinatura do Stripe');
            return response()->json(['error' => 'Assinatura não encontrada'], 400);
        }

        try {
            // Verifica a assinatura do webhook
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('stripe-signature'),
                config('services.stripe.webhook.secret')
            );

            // Adiciona o evento Stripe à requisição
            $request->merge(['stripe_event' => $event]);

            return $next($request);

        } catch (SignatureVerificationException $e) {
            Log::warning('Assinatura do webhook inválida:', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Assinatura inválida'], 400);

        } catch (\Exception $e) {
            Log::error('Erro ao verificar assinatura do webhook:', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Erro interno'], 500);
        }
    }
}
