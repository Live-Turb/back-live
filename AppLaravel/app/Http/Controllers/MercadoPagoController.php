<?php

namespace App\Http\Controllers;
use App\Models\PayPalPlan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\ViewBillingRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\Auth;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;

use App\Mail\SubscriptionSuccessMail;
use Illuminate\Support\Facades\Mail;
use App\Services\ViewTrackingService;

class MercadoPagoController extends Controller
{
    private $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    public function processMercadoPagoTransaction(Request $request, $planUUID, $userUUID)
    {
        $user = User::where('uuid', $userUUID)->first();
        $plan = PayPalPlan::where('uuid', $planUUID)->first();

        if (!$user || !$plan) {
            return redirect()->route('landing');
        }

        \MercadoPago\SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $preference = new \MercadoPago\Preference();

        $item = new \MercadoPago\Item();
        $item->title = $plan->name;
        $item->description = $plan->description;
        $item->quantity = 1;
        $item->currency_id = 'BRL';
        $item->unit_price = $plan->price;

        $preference->items = [$item];

        $payer = new \MercadoPago\Payer();
        $payer->email = $user->email;
        $payer->name = $user->name;

        $preference->payer = $payer;

        $preference->back_urls = [
            'success' => route('mercadopago.success'),
            'failure' => route('mercadopago.failure'),
        ];

        $preference->auto_return = 'approved';
        $preference->external_reference = uniqid();
        try {
            $preference->save();

            $status = "PENDING";
            $subscription = Subscription::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'plan_id' => $plan->id,
                    'mercadopago_id' => $preference->id,
                    'status' => $status,
                    'start_time' => Carbon::now(),
                    'expire_date' => Carbon::now()->addMonth($plan->duration),
                ]
            );

            // Reseta contagens de visualização após upgrade
            if ($subscription->wasRecentlyCreated || $subscription->wasChanged('plan_id')) {
                $this->viewTrackingService->resetViewCountsAfterUpgrade($user->id);
            }

            return redirect()->to($preference->init_point);

        } catch (\Exception $e) {
            return redirect()->route('landing')->with('error', 'Error processing the payment: ' . $e->getMessage());
        }
    }

    public function successTransactionMercadoPago(Request $request)
    {
        $subscription = Subscription::where('mercadopago_id', $request['preference_id'])->first();
        if (!$subscription) {
            return redirect()->route('landing')->with(['error' => 'Subscription not found']);
        }

        $subscription->status = "ACTIVE";
        $subscription->paypal_id = null;
        $subscription->stripe_id = null;
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
    public function cancelTransactionMercadoPago(Request $request)
    {
        return redirect()->route('landing')->with('error', 'You have canceled the transaction.');
    }

    public function failureTransactionMercadoPago(Request $request)
    {
        return redirect()->route('landing')->with('error', 'Transaction failed.');
    }
}
