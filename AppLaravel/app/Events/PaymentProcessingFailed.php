<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentProcessingFailed
{
    use Dispatchable, SerializesModels;

    public $paymentIntent;
    public $error;

    /**
     * Create a new event instance.
     *
     * @param mixed $paymentIntent
     * @param \Exception $error
     * @return void
     */
    public function __construct($paymentIntent, \Exception $error)
    {
        $this->paymentIntent = $paymentIntent;
        $this->error = $error;
    }
}
