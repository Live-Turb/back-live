<?php

namespace App\Notifications;

use App\Models\ViewBillingRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentFailed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $billingRecord;
    protected $error;

    public function __construct(ViewBillingRecord $billingRecord, $error)
    {
        $this->billingRecord = $billingRecord;
        $this->error = $error;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $amount = number_format($this->billingRecord->extra_views_cost, 2, ',', '.');
        
        return (new MailMessage)
            ->subject('Falha no Processamento do Pagamento')
            ->greeting('Olá ' . $notifiable->name)
            ->line('Houve um problema ao processar seu pagamento.')
            ->line('Detalhes da tentativa:')
            ->line("- Visualizações Extras: {$this->billingRecord->extra_views}")
            ->line("- Valor: R$ {$amount}")
            ->line("- Motivo da Falha: {$this->error}")
            ->line("- Data: " . now()->format('d/m/Y H:i:s'))
            ->action('Tentar Novamente', route('billing.show', $this->billingRecord->id))
            ->line('Se precisar de ajuda, entre em contato com nosso suporte.');
    }
}
