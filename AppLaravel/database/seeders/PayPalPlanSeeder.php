<?php

namespace Database\Seeders;

use App\Models\PayPalPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayPalPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planBasic = PayPalPlan::create([
            'uuid' => \Str::uuid(),
            'name' => "Basic",
            'duration' => 1,
            'price' => 97,
            'plan_key' => "P-6G756250U61660016M2ACQKI",
            'stripe_plan_key' => "price_1PkkFMLRcazkgCpcsKC3NH8R",
            'limit' => 1,
            'views_limit' => 6000,
            'comment_limit' => 180,
            'step' => 1
        ]);
        $planStandard = PayPalPlan::create([
            'uuid' => \Str::uuid(),
            'name' => "Standard",
            'duration' => 1,
            'price' => 297,
            'plan_key' => "P-6CP667220G2190821M2ACS2I",
            'stripe_plan_key' => "price_1PkkFuLRcazkgCpcDzoZXMX3",
            'limit' => 2,
            'views_limit' => 25000,
            'comment_limit' => 240,
            'step' => 2
        ]);
        $planPremium = PayPalPlan::create([
            'uuid' => \Str::uuid(),
            'name' => "Premium",
            'duration' => 1,
            'price' => 597,
            'plan_key' => "P-99N85962CW5541636M2ACU7I",
            'stripe_plan_key' => "price_1PkkGQLRcazkgCpcDEMgZdzq",
            'limit' => 3,
            'views_limit' => 50000,
            'comment_limit' => 370,
            'step' => 3
        ]);
    }
}
