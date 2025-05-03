<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ViewsLimitWarning extends Notification implements ShouldQueue
{
    use Queueable;

    protected $currentViews;
    protected $limit;
    protected $remaining;
    protected $percentageUsed;

    public function __construct($currentViews, $limit, $remaining)
    {
        $this->currentViews = $currentViews;
        $this->limit = $limit;
        $this->remaining = $remaining;
        $this->percentageUsed = round(($currentViews / $limit) * 100);
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Aviso: Limite de Visualizações')
            ->greeting('Olá ' . $notifiable->name)
            ->line("Você está se aproximando do seu limite mensal de visualizações.")
            ->line("Detalhes do uso:")
            ->line("- Visualizações Utilizadas: {$this->currentViews}")
            ->line("- Limite do Plano: {$this->limit}")
            ->line("- Visualizações Restantes: {$this->remaining}")
            ->line("- Porcentagem Utilizada: {$this->percentageUsed}%")
            ->action('Ver Detalhes', route('analytics.dashboard'))
            ->line('Considere gerenciar suas visualizações ou atualizar seu plano para evitar cobranças extras.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'views_limit_warning',
            'current_views' => $this->currentViews,
            'limit' => $this->limit,
            'remaining' => $this->remaining,
            'percentage_used' => $this->percentageUsed
        ];
    }
}
