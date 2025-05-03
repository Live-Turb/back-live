<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $event = $request->all();

        switch ($event['event_type']) {
            case 'BILLING.SUBSCRIPTION.CREATED':
                // Handle subscription created
                $subscription = Subscription::where('paypal_id', $event['resource']['id'])->first();
                if ($subscription) {
                    $subscription->update(['status' => 'ACTIVE']);
                }
                break;
            case 'BILLING.SUBSCRIPTION.CANCELLED':
                // Handle subscription cancelled
                $subscription = Subscription::where('paypal_id', $event['resource']['id'])->first();
                if ($subscription) {
                    $subscription->update(['status' => 'CANCELLED']);
                }
                break;
            case 'BILLING.SUBSCRIPTION.RENEWED':
                // Handle subscription renewed
                $subscription = Subscription::where('paypal_id', $event['resource']['id'])->first();
                if ($subscription) {
                    $subscription->update(['status' => 'ACTIVE']);
                }
                break;
            // Add other event types as needed
        }

        return response()->json(['status' => 'success']);
    }
}
