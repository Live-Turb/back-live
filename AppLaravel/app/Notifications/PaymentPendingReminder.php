<?php

namespace App\Notifications;

use App\Models\ViewBillingRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentPendingReminder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $billingRecord;
    protected $daysPending;

    public function __construct(ViewBillingRecord $billingRecord, $daysPending)
    {
        $this->billingRecord = $billingRecord;
        $this->daysPending = $daysPending;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $amount = number_format($this->billingRecord->extra_views_cost, 2, ',', '.');
        
        return (new MailMessage)
            ->subject('Lembrete: Pagamento Pendente')
            ->greeting('Olá ' . $notifiable->name)
            ->line("Você tem um pagamento pendente há {$this->daysPending} dias.")
            ->line('Detalhes da cobrança:')
            ->line("- Visualizações Extras: {$this->billingRecord->extra_views}")
            ->line("- Valor: R$ {$amount}")
            ->line("- Data da Cobrança: " . $this->billingRecord->created_at->format('d/m/Y'))
            ->action('Pagar Agora', route('billing.show', $this->billingRecord->id))
            ->line('Mantenha seus pagamentos em dia para continuar aproveitando todos os recursos.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'payment_pending_reminder',
            'billing_record_id' => $this->billingRecord->id,
            'amount' => $this->billingRecord->extra_views_cost,
            'days_pending' => $this->daysPending
        ];
    }
}
