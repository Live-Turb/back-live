<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminPaymentFailureNotification extends Notification
{
    use Queueable;

    protected $paymentIntent;
    protected $error;

    /**
     * Create a new notification instance.
     *
     * @param mixed $paymentIntent
     * @param \Exception $error
     * @return void
     */
    public function __construct($paymentIntent, \Exception $error)
    {
        $this->paymentIntent = $paymentIntent;
        $this->error = $error;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $amount = isset($this->paymentIntent->amount) 
            ? number_format($this->paymentIntent->amount / 100, 2) 
            : 'N/A';

        return (new MailMessage)
            ->error()
            ->subject('Falha no Processamento de Pagamento')
            ->greeting('Atenção Administrador')
            ->line('Houve uma falha no processamento de um pagamento que requer sua atenção.')
            ->line('Detalhes do Pagamento:')
            ->line("ID do Payment Intent: {$this->paymentIntent->id ?? 'N/A'}")
            ->line("Valor: R$ {$amount}")
            ->line('Erro:')
            ->line($this->error->getMessage())
            ->action('Ver Detalhes no Dashboard', url('/admin/dashboard'))
            ->line('Por favor, verifique o sistema e tome as ações necessárias.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'payment_intent_id' => $this->paymentIntent->id ?? null,
            'amount' => $this->paymentIntent->amount ?? null,
            'error_message' => $this->error->getMessage(),
            'error_code' => $this->error->getCode(),
            'occurred_at' => now()->toIso8601String()
        ];
    }
}
