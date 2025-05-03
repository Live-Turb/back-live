<?php

namespace App\Listeners;

use App\Events\PaymentProcessingFailed;
use App\Models\User;
use App\Notifications\AdminPaymentFailureNotification;
use Illuminate\Support\Facades\Log;

class NotifyAdminsOfPaymentFailure
{
    /**
     * Handle the event.
     *
     * @param PaymentProcessingFailed $event
     * @return void
     */
    public function handle(PaymentProcessingFailed $event)
    {
        try {
            // Notifica todos os administradores
            $admins = User::where('is_admin', true)->get();
            
            foreach ($admins as $admin) {
                $admin->notify(new AdminPaymentFailureNotification(
                    $event->paymentIntent,
                    $event->error
                ));
            }

            // Log detalhado do erro
            Log::error('Falha no processamento do pagamento notificada aos administradores', [
                'payment_intent_id' => $event->paymentIntent->id ?? null,
                'error_message' => $event->error->getMessage(),
                'error_trace' => $event->error->getTraceAsString()
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao notificar administradores sobre falha no pagamento', [
                'error' => $e->getMessage(),
                'original_error' => $event->error->getMessage()
            ]);
        }
    }
}
