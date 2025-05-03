<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ViewTrackingService;
use App\Models\User;
use App\Models\Subscription;
use App\Models\PayPalPlan;
use Illuminate\Support\Facades\Cache;

class ResetUserViewCounts extends Command
{
    protected $signature = 'user:reset-views {email}';
    protected $description = 'Reset view counts for a specific user';

    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        parent::__construct();
        $this->viewTrackingService = $viewTrackingService;
    }

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User not found with email: {$email}");
            return 1;
        }

        // Verifica a assinatura atual
        $subscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->whereDate('expire_date', '>=', now())
            ->with('paypalPlan')
            ->first();

        if (!$subscription || !$subscription->paypalPlan) {
            $this->error("No active subscription found for user: {$email}");
            return 1;
        }

        $this->info("Current Plan: {$subscription->paypalPlan->name}");
        $this->info("Views Limit: {$subscription->paypalPlan->views_limit}");

        // Força o reset das contagens
        if ($this->viewTrackingService->resetViewCountsAfterUpgrade($user->id)) {
            Cache::forget("user_plan_views_limit_{$user->id}");
            $this->info("Successfully reset view counts for user: {$email}");
            return 0;
        }

        $this->error("Failed to reset view counts for user: {$email}");
        return 1;
    }
}
