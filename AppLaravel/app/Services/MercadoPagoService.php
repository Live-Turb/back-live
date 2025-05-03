<?php

namespace App\Services;

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Exceptions\MPApiException;

class MercadoPagoService
{
    public function __construct()
    {
        
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
    }

    /**
     * Create a subscription with Mercado Pago.
     *
     * @param array $package - The package details (name, description, price).
     * @param \App\Models\User $user - The user who is subscribing.
     * @return string - The checkout URL.
     * @throws \Exception
     */
    public function createSubscription(array $package, $user)
    {
         $items = [
            [
                'title' => $package['name'],
                'description' => $package['description'],
                'quantity' => 1,
                'currency_id' => 'BRL',
                'unit_price' => $package['price'],
            ]
        ];

        $payer = [
            'email' => $user->email,
            'name' => $user->name,
        ];

        $backUrls = [
            'success' => route('mercadopago.success'),
            'failure' => route('mercadopago.failure'),
        ];

        $request = [
            'items' => $items,
            'payer' => $payer,
            'payment_methods' => [
                'installments' => 1
            ],
            'back_urls' => $backUrls,
            'auto_return' => 'approved',
            'external_reference' => uniqid(), // You can store this reference in your database
        ];

        try {
            // Initialize the Mercado Pago client and create the preference
            $client = new PreferenceClient();
            $preference = $client->create($request);

            // Return the Mercado Pago checkout URL
            return $preference->init_point;
        } catch (MPApiException $e) {
            throw new \Exception('Error creating Mercado Pago preference: ' . $e->getMessage());
        }
    }
}
