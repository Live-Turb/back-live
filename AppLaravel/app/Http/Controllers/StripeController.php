<?php

namespace App\Http\Controllers;

use App\Models\PayPalPlan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\ViewBillingRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Auth;
use App\Mail\SubscriptionSuccessMail;
use Illuminate\Support\Facades\Mail;
use App\Services\ViewTrackingService;

class StripeController extends Controller
{
    private $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    public function processStripeTransaction(Request $request, $planUUID, $userUUID)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = User::where('uuid', $userUUID)->first();
        $plan = PayPalPlan::where('uuid', $planUUID)->first();
        if (!$user || !$plan) {
            return redirect()->route('landing');
        }

        $priceId = $plan->stripe_plan_key;
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'customer_email' => $user->email,
            'success_url' => route('successTransactionStripe') . '?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route('cancelTransactionStripe'),
        ]);

        $status = "PENDING";
        $subscription = Subscription::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'plan_id' => $plan->id,
                'stripe_id' => $session->id,
                'status' => $status,
                'start_time' => Carbon::now(),
                'expire_date' => Carbon::now()->addMonth($plan->duration),
            ]
        );

        // Reseta contagens de visualização após upgrade
        if ($subscription->wasRecentlyCreated || $subscription->wasChanged('plan_id')) {
            $this->viewTrackingService->resetViewCountsAfterUpgrade($user->id);
        }

        return redirect($session->url);
    }


    public function successTransactionStripe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session_id = $request->query('session_id');
        $session = StripeSession::retrieve($session_id);

        $subscription = Subscription::where('stripe_id', $session->id)->first();
        if (!$subscription) {
            return redirect()->route('landing')->with(['error' => 'Subscription not found']);
        }

        $subscription->status = "ACTIVE";
        $subscription->paypal_id = null;
        $subscription->mercadopago_id = null;
        $subscription->save();

        // Registrar no histórico de faturas
        $this->registerSubscriptionPayment($subscription);

        // Fazer login do usuário
        Auth::loginUsingId($subscription->user_id);
        
        $data = [
            'plan_name' => $subscription->paypalPlan->name,
            'email' => $subscription->user->email,
            'username'=> $subscription->user->name,
            'price'=> $subscription->paypalPlan->price,
        ];

        try {
            Mail::to($subscription->user->email)->send(new SubscriptionSuccessMail($data));
        } catch (\Exception $e) {
            \Log::error('Failed to send subscription success email: ' . $e->getMessage());
        }

        // Garantir que o usuário está logado antes de redirecionar
        if (!Auth::check()) {
            Auth::loginUsingId($subscription->user_id);
        }

        return redirect()->route('myBroadcasts')->with(['success' => 'Subscription complete.']);
    }

    /**
     * Registra o pagamento da assinatura no histórico de faturas
     */
    private function registerSubscriptionPayment(Subscription $subscription)
    {
        try {
            // Criar registro na tabela de histórico de faturas
            ViewBillingRecord::create([
                'user_id' => $subscription->user_id,
                'extra_views' => 0, // Não há visualizações extras, é pagamento de plano
                'extra_views_cost' => $subscription->paypalPlan->price,
                'status' => 'processed',
                'paid_at' => now(),
                'notes' => 'Pagamento de assinatura do plano ' . $subscription->paypalPlan->name,
                'billing_period_start' => $subscription->start_time,
                'billing_period_end' => $subscription->expire_date,
                'total_views' => 0,
                'description' => 'Assinatura do plano ' . $subscription->paypalPlan->name,
                'amount' => $subscription->paypalPlan->price
            ]);
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar pagamento no histórico: ' . $e->getMessage());
        }
    }

    /**
     * Cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransactionStripe(Request $request)
    {
        return redirect()->route('landing')->with('error', 'You have canceled the transaction.');
    }
}
