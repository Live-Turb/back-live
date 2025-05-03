<?php

namespace App\Events;

use App\Models\ViewBillingRecord;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentProcessed
{
    use Dispatchable, SerializesModels;

    public $billingRecord;
    public $paymentIntent;

    /**
     * Create a new event instance.
     *
     * @param ViewBillingRecord $billingRecord
     * @param mixed $paymentIntent
     * @return void
     */
    public function __construct(ViewBillingRecord $billingRecord, $paymentIntent)
    {
        $this->billingRecord = $billingRecord;
        $this->paymentIntent = $paymentIntent;
    }
}
