<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class IntallLiveStreeming extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:streaming';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install LiveStreeming';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->info('Database migrated successfully.');

        Artisan::call('db:seed', ['--class' => 'Database\Seeders\DatabaseSeeder']);
        Artisan::call('db:seed', ['--class' => 'Database\Seeders\PayPalPlanSeeder']);
        $this->info('Database seeded successfully.');
    }
}
