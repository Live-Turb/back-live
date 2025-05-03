<?php

namespace App\Exceptions;

class BillingException extends \Exception
{
    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'billing_error',
                'message' => $this->getMessage()
            ], 403);
        }

        return response()->view('errors.billing', [
            'message' => $this->getMessage()
        ], 403);
    }
}
