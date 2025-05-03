<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ViewBillingRecord;

class PaymentProcessedNotification extends Notification
{
    use Queueable;

    protected $billingRecord;
    protected $paymentIntent;

    /**
     * Create a new notification instance.
     *
     * @param ViewBillingRecord $billingRecord
     * @param mixed $paymentIntent
     * @return void
     */
    public function __construct(ViewBillingRecord $billingRecord, $paymentIntent)
    {
        $this->billingRecord = $billingRecord;
        $this->paymentIntent = $paymentIntent;
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
        $amount = number_format($this->billingRecord->extra_views_cost, 2);

        return (new MailMessage)
            ->subject('Pagamento Processado com Sucesso')
            ->greeting('Olá ' . $notifiable->name)
            ->line('Seu pagamento foi processado com sucesso!')
            ->line("Valor: R$ {$amount}")
            ->line('Detalhes do pagamento:')
            ->line("- ID do Pagamento: {$this->paymentIntent->id}")
            ->line("- Views extras: {$this->billingRecord->extra_views}")
            ->line('Suas visualizações extras já foram liberadas e você pode continuar usando normalmente.')
            ->action('Ver Detalhes', url('/billing'))
            ->line('Obrigado por usar nossos serviços!');
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
            'billing_record_id' => $this->billingRecord->id,
            'payment_intent_id' => $this->paymentIntent->id,
            'amount' => $this->billingRecord->extra_views_cost,
            'extra_views' => $this->billingRecord->extra_views,
            'processed_at' => now()->toIso8601String()
        ];
    }
}
