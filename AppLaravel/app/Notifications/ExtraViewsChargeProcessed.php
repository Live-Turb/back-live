<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ViewBillingRecord;

class ExtraViewsChargeProcessed extends Notification
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
            ->subject('Cobrança de Visualizações Extras Processada')
            ->greeting('Olá ' . $notifiable->name)
            ->line('A cobrança referente às suas visualizações extras foi processada com sucesso.')
            ->line('Detalhes da cobrança:')
            ->line('- Período: ' . $this->billingRecord->billing_period_start->format('d/m/Y') . ' a ' . $this->billingRecord->billing_period_end->format('d/m/Y'))
            ->line('- Visualizações extras: ' . number_format($this->billingRecord->extra_views))
            ->line('- Valor cobrado: R$ ' . number_format($this->billingRecord->extra_views_cost, 2, ',', '.'))
            ->action('Ver Detalhes', route('analytics.views'))
            ->line('Obrigado por usar nossa plataforma!');
    }

    public function toArray($notifiable)
    {
        return [
            'billing_record_id' => $this->billingRecord->id,
            'extra_views' => $this->billingRecord->extra_views,
            'cost' => $this->billingRecord->extra_views_cost,
            'period_start' => $this->billingRecord->billing_period_start->format('Y-m-d'),
            'period_end' => $this->billingRecord->billing_period_end->format('Y-m-d')
        ];
    }
}
