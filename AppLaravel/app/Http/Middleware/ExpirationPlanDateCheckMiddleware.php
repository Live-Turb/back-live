<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class ExpirationPlanDateCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
    
        if (Auth::check()) {

            if(auth()->user()->subscriptions && auth()->user()->subscriptions->status){
                $currentDate = Carbon::now();
                $expireDate = Carbon::parse(auth()->user()->subscriptions->expire_date);
                $user = auth()->user();
                if ($expireDate->greaterThanOrEqualTo($currentDate)) {

                    return redirect()->route('myBroadcasts');
                } else {
                    $mystatus = Subscription::find($user->subscriptions->id);
                    $mystatus->status = 'EXPIRE';
                    $mystatus->save();
                    return redirect()->route('currentSubscription');
                }
            }else{
                auth()->logout();
                return redirect()->route('login')->with(['error' => 'Your are not a member']);
            }
            return $next($request);
        }else{
            return redirect()->route('login')->with(['error' => 'Your are not login']);
        }
    
    }
    
}
