<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Subscription;
use App\Models\PayPalPlan;

class CheckUserSubscription extends Command
{
    protected $signature = 'check:subscription {email}';
    protected $description = 'Check subscription details for a user';

    public function handle()
    {
        $email = $this->argument('email');
        
        // Encontra o usuário
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User not found: {$email}");
            return 1;
        }

        $this->info("\nUser Details:");
        $this->info("ID: {$user->id}");
        $this->info("Name: {$user->name}");
        $this->info("Email: {$user->email}");

        // Verifica todas as assinaturas
        $subscriptions = Subscription::where('user_id', $user->id)
            ->with('paypalPlan')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->info("\nAll Subscriptions:");
        foreach ($subscriptions as $subscription) {
            $this->info("\n- Subscription ID: {$subscription->id}");
            $this->info("  Created At: {$subscription->created_at}");
            $this->info("  Status: {$subscription->status}");
            $this->info("  Expire Date: {$subscription->expire_date}");
            if ($subscription->paypalPlan) {
                $this->info("  Plan Name: {$subscription->paypalPlan->name}");
                $this->info("  Plan Views Limit: {$subscription->paypalPlan->views_limit}");
            } else {
                $this->info("  No PayPal Plan attached!");
            }
        }

        // Verifica assinatura ativa
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->whereDate('expire_date', '>=', now())
            ->with('paypalPlan')
            ->orderBy('created_at', 'desc')
            ->first();

        $this->info("\nActive Subscription:");
        if ($activeSubscription) {
            $this->info("ID: {$activeSubscription->id}");
            $this->info("Status: {$activeSubscription->status}");
            $this->info("Expire Date: {$activeSubscription->expire_date}");
            if ($activeSubscription->paypalPlan) {
                $this->info("Plan Name: {$activeSubscription->paypalPlan->name}");
                $this->info("Plan Views Limit: {$activeSubscription->paypalPlan->views_limit}");
            } else {
                $this->info("No PayPal Plan attached!");
            }
        } else {
            $this->info("No active subscription found!");
        }

        // Lista todos os planos disponíveis
        $this->info("\nAll Available Plans:");
        $plans = PayPalPlan::all();
        foreach ($plans as $plan) {
            $this->info("- {$plan->name}: {$plan->views_limit} views (ID: {$plan->id})");
        }

        return 0;
    }
}
