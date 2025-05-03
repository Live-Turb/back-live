<?php

namespace App\Http\Controllers;

use App\Models\PayPalPlan;
use App\Models\User;
use App\Models\Subscription;
use App\Models\ViewBillingRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Mail\SubscriptionSuccessMail;
use Illuminate\Support\Facades\Mail;
use App\Services\ViewTrackingService;

class PayPalController extends Controller
{
    private $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    /**
     * Create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('paypal.transaction');
    }

    /**
     * Process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request, $planUUID, $userUUID)
    {
        $user = User::where('uuid', $userUUID)->first();
        $plan = PayPalPlan::where('uuid', $planUUID)->first();
        if (!$user || !$plan) {
            return redirect()->route('landing');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $planId = $plan->plan_key;
        $planDuration = $plan->duration;

        $response = $provider->createSubscription([
            'plan_id' => $planId,
            'application_context' => [
                'brand_name' => env('APP_NAME'),
                'locale' => 'en-US',
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'SUBSCRIBE_NOW',
                'return_url' => route('successTransaction'),
                'cancel_url' => route('cancelTransaction'),
            ],
            'subscriber' => [
                'name' => [
                    'given_name' => "testFirstName",
                    'surname' => "testLastName",
                ],
                'email_address' => "testFirstName@gmail.com",

            ]
        ]);
        if (isset($response['error'])) {
            return redirect()->route('landing')->with(['error' => "Payment are not allowed"]);
        }

        $status = $response['status'];
        $status = "PENDING";
        $subscription = Subscription::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'plan_id' => $plan->id,
                'paypal_id' => $response['id'],
                'status' => $status,
                'start_time' => Carbon::now(),
                'expire_date' => Carbon::now()->addMonth("$planDuration"),
            ]
        );

        // Reseta contagens de visualização após upgrade
        if ($subscription->wasRecentlyCreated || $subscription->wasChanged('plan_id')) {
            $oldPlan = $subscription->getOriginal('plan_id') ? PayPalPlan::find($subscription->getOriginal('plan_id')) : null;
            $oldPlanName = $oldPlan ? $oldPlan->name : 'Basic';
            $this->viewTrackingService->resetViewCountsAfterUpgrade($user->id);
        }

        if (isset($response['id']) && $response['id'] != null) {
            // dd($response);
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * Success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->showSubscriptionDetails($request['subscription_id']);

        $subscription = Subscription::where('paypal_id', $response['id'])->first();
        if (!$subscription) {
            return redirect()->route('landing')->with(['error' => 'Subscription not found']);
        }

        $subscription->status = "ACTIVE";
        $subscription->stripe_id = null;
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
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $request['message'] ?? 'You have canceled the transaction.');
    }
}
