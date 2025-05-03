<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\SubscriptionExpiredMail;
use Illuminate\Support\Facades\Mail;


class CheckUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (auth()->user() && auth()->user()->hasRole('user')) {
            if (auth()->user()->subscriptions == null) {
                return redirect()->route('currentSubscription');
            }
            if (auth()->user()->subscriptions != null) {
                if (auth()->user()->subscriptions->status == 'ACTIVE') {
                    $nowTime = Carbon::now();
                    $endTime = Carbon::parse(auth()->user()->subscriptions->expire_date);
                        $subscription = auth()->user()->subscriptions;
            $data = [
                'plan_name' => $subscription->paypalPlan->name ?? 'N/A',
                'email' => $subscription->user->email,
                'user_name' => auth()->user()->name,
                'expire_date' => Carbon::parse($subscription->expire_date)->format('F j, Y'),
            ];
                    if ($nowTime->greaterThan($endTime)) {
                         try {
          Mail::to(auth()->user()->email)->send(new SubscriptionExpiredMail($data));
    } catch (\Exception $e) {
     
        return redirect()->route('currentSubscription')->with('error', 'Your subscription has expired but we facing issues on sending email.');
    }
                       
                        return redirect()->route('currentSubscription')->with(['error' => 'Your subscription has expired']);
                    }
                    return $next($request);
                } else {
                    return redirect()->route('currentSubscription')->with(['error' => __('dashboard.subscription_not_active')]);

                }
            }

        } else {
            return redirect()->route('landing');
        }
    }
}
