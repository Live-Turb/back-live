<?php

namespace App\Http\Controllers;

use App\Models\PayPalPlan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\VideoDetail;
use Illuminate\Http\Request;
use App\Models\BroadCastThumbnail;
use App\Mail\SubscriptionCancelledMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CurrentSubscriptionController extends Controller
{
    // Profile management view
    function profileManagement()
    {
        return view('profile-management');
    }
    
    // My broadcast view
    function myBroadcasts()
    {
        $auth = auth()->user();
        // $showThumbnails = BroadCastThumbnail::where("user_id", $auth->id)->get();
        // dd($showThumbnail->user_id);
        $myvideos = VideoDetail::with('videoThumbnail')->where('user_id', auth()->id())->get();
        $planLimit = Subscription::where('user_id', auth()->id())->first();
        $isLimit = false;
        if ($planLimit->paypalPlan) {
            $limit = $planLimit->paypalPlan->limit;
            if ($limit <= count($myvideos)) {
                $isLimit = true;
            }
        }
        return view('my-broadcasts', compact('myvideos', 'isLimit'));
    }

    // Comment management view
    function commentManagement()
    {
        $videos = VideoDetail::where('user_id', auth()->id())->get();

        return view('comment-management', compact('videos'));
    }

    // Current subscription view
    function currentSubscription()
    {
        $plans = PayPalPlan::all();
        if (auth()->user() && auth()->user()->hasRole('user')) {
            return view('current-subscription', compact('plans'));
        } else {
            return redirect()->route('login');
        }
    }

    public function cancel($id)
    {
        $subscription = Subscription::find($id);
        if ($subscription) {
            $subscription->status = 'CANCELLED';
            $subscription->save();
            
            $data = [
                'plan_name' => $subscription->paypalPlan->name ?? 'N/A',
                'email' => $subscription->user->email,
                'user_name' => $subscription->user->name,
                'expire_date' => Carbon::parse($subscription->expire_date)->format('F j, Y'),
            ];
            
            try {
                // Send cancellation email
                Mail::to($subscription->user->email)->send(new SubscriptionCancelledMail($data));
            } catch (\Exception $e) {
                return redirect()->back()->with('success', __('dashboard.subscription_canceled_successfully') . ' However, there was an issue sending the cancellation email.');
            }
            return redirect()->back()->with('success', __('dashboard.subscription_canceled_successfully'));
        }
        return redirect()->back()->with('error', 'Subscription not found.');
    }

    public function upgrade(Request $request, $planUUID, $userUUID)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ], [
            'payment_method.required' =>  __('validation.payment_method.required'),
        ]);

        $user = User::where('uuid', $userUUID)->first();
        $plan = PayPalPlan::where('uuid', $planUUID)->first();

        if (!$user || !$plan) {
            return redirect()->route('landing')->with('error', 'Invalid user or plan.');
        }
        
        if($request->action_type == 'downgrade'){
            $this->handleUserDataDeletion($user);
            
            if ($request->payment_method === 'paypal') {
                return view('paypal.process-to-continue', compact('plan', 'user'));
            } elseif ($request->payment_method === 'stripe') {
                return app(StripeController::class)->processStripeTransaction($request, $plan->uuid, $user->uuid);
            } elseif ($request->payment_method == 'mercado_pago') {
                return app(MercadoPagoController::class)->processMercadoPagoTransaction($request, $plan->uuid, $user->uuid);
            }
        } else {
            if ($request->payment_method === 'paypal') {
                return view('paypal.process-to-continue', compact('plan', 'user'));
            } elseif ($request->payment_method === 'stripe') {
                return app(StripeController::class)->processStripeTransaction($request, $plan->uuid, $user->uuid);
            } elseif ($request->payment_method == 'mercado_pago') {
                return app(MercadoPagoController::class)->processMercadoPagoTransaction($request, $plan->uuid, $user->uuid);
            }
        }
    }
    
    private function handleUserDataDeletion(User $user)
    {
        $videoDetails = VideoDetail::where('user_id', $user->id)->get();
        
        foreach ($videoDetails as $videoDetail) {
            $videoDetail->videoThumbnail()->delete();
            $videoDetail->videoComment()->delete();
            $videoDetail->delete();
        }
    }

    // Método index para a página de assinatura atual
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $subscription = Subscription::where('user_id', $user->id)
                              ->where('status', 'ACTIVE')
                              // Não verificamos mais a data de expiração
                              ->with('paypalPlan')
                              ->first();

        // Verifica se o usuário tem uma assinatura ativa
        $isSubscribed = !is_null($subscription);
        
        // Obtém os planos do PayPal
        $paypalPlans = PayPalPlan::all();
        
        // Retorna a view com os dados
        return view('current-subscription', [
            'subscription' => $subscription,
            'isSubscribed' => $isSubscribed,
            'paypalPlans' => $paypalPlans,
        ]);
    }
}
