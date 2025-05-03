<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeChargeService;
use Stripe\Webhook;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    protected $stripeChargeService;

    public function __construct(StripeChargeService $stripeChargeService)
    {
        $this->stripeChargeService = $stripeChargeService;
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                config('services.stripe.webhook.secret')
            );

            // Processa o evento
            $this->stripeChargeService->handlePaymentWebhook($event);

            return response()->json(['status' => 'success']);

        } catch (\UnexpectedValueException $e) {
            Log::error('Erro no webhook do Stripe: Payload inválido', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Payload inválido'], 400);

        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Erro no webhook do Stripe: Assinatura inválida', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Assinatura inválida'], 400);

        } catch (\Exception $e) {
            Log::error('Erro no webhook do Stripe: Erro geral', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['error' => 'Erro interno'], 500);
        }
    }
}
