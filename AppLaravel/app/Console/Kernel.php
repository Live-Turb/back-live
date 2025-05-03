<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Processa cobranças extras todos os dias à meia-noite
        $schedule->command('views:process-charges')->dailyAt('00:00');

        // Verifica notificações a cada hora
        $schedule->command('notifications:check')
            ->hourly()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/notifications.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected $commands = [
        Commands\SetupCountryFlags::class,
        Commands\SimulateViewsLimit::class,
        Commands\ProcessTranscricoes::class,
    ];
}
