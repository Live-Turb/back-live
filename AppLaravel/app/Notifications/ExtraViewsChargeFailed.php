<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ViewBillingRecord;

class ExtraViewsChargeFailed extends Notification
{
    use Queueable;

    protected $billingRecord;

    public function __construct(ViewBillingRecord $billingRecord)
    {
        $this->billingRecord = $billingRecord;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Falha na Cobrança de Visualizações Extras')
            ->greeting('Olá ' . $notifiable->name)
            ->line('Houve um problema ao processar a cobrança das suas visualizações extras.')
            ->line('Detalhes da cobrança:')
            ->line('- Período: ' . $this->billingRecord->billing_period_start->format('d/m/Y') . ' a ' . $this->billingRecord->billing_period_end->format('d/m/Y'))
            ->line('- Visualizações extras: ' . number_format($this->billingRecord->extra_views))
            ->line('- Valor pendente: R$ ' . number_format($this->billingRecord->extra_views_cost, 2, ',', '.'))
            ->line('Por favor, verifique se seu método de pagamento está atualizado.')
            ->action('Atualizar Método de Pagamento', route('billing.payment-methods'))
            ->line('Se precisar de ajuda, entre em contato com nosso suporte.');
    }

    public function toArray($notifiable)
    {
        return [
            'billing_record_id' => $this->billingRecord->id,
            'extra_views' => $this->billingRecord->extra_views,
            'cost' => $this->billingRecord->extra_views_cost,
            'period_start' => $this->billingRecord->billing_period_start->format('Y-m-d'),
            'period_end' => $this->billingRecord->billing_period_end->format('Y-m-d'),
            'error' => json_decode($this->billingRecord->notes)->error ?? 'Erro desconhecido'
        ];
    }
}
