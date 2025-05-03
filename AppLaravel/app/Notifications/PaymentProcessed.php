<?php

namespace App\Notifications;

use App\Models\ViewBillingRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentProcessed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $billingRecord;
    protected $paymentIntent;

    public function __construct(ViewBillingRecord $billingRecord, $paymentIntent)
    {
        $this->billingRecord = $billingRecord;
        $this->paymentIntent = $paymentIntent;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $amount = number_format($this->billingRecord->extra_views_cost, 2, ',', '.');
        
        return (new MailMessage)
            ->subject('Pagamento Processado com Sucesso')
            ->greeting('Olá ' . $notifiable->name)
            ->line('Seu pagamento foi processado com sucesso!')
            ->line('Detalhes da transação:')
            ->line("- Visualizações Extras: {$this->billingRecord->extra_views}")
            ->line("- Valor: R$ {$amount}")
            ->line("- ID da Transação: {$this->paymentIntent->id}")
            ->line("- Data: " . now()->format('d/m/Y H:i:s'))
            ->action('Ver Detalhes', route('billing.show', $this->billingRecord->id))
            ->line('Obrigado por usar nossos serviços!');
    }
}
