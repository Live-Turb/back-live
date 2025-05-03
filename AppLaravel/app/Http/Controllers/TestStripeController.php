<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class TestStripeController extends Controller
{
    public function testConnection()
    {
        try {
            // Tenta buscar a lista de clientes para testar a conexão
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $customers = $stripe->customers->all(['limit' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Conexão com Stripe estabelecida com sucesso!',
                'data' => [
                    'customer_count' => $customers->count(),
                    'stripe_version' => Stripe::VERSION
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao conectar com Stripe: ' . $e->getMessage()
            ], 500);
        }
    }
}
