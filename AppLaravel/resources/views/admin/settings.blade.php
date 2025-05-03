@extends('layouts.app')

@section('content')

 
    <form action="{{ route('update.payment.settings') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="stripe_secret">Stripe Secret Key</label>
            <input type="text" class="form-control @error('stripe_secret') is-invalid @enderror" id="stripe_secret" name="stripe_secret" value="{{ old('stripe_secret', env('STRIPE_SECRET')) }}">
            @error('stripe_secret')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="mercado_pago_access_token">Mercado Pago Access Token</label>
            <input type="text" class="form-control @error('mercado_pago_access_token') is-invalid @enderror" id="mercado_pago_access_token" name="mercado_pago_access_token" value="{{ old('mercado_pago_access_token', env('MERCADO_PAGO_ACCESS_TOKEN')) }}">
            @error('mercado_pago_access_token')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="paypal_mode">PayPal Mode</label>
            <input type="text" class="form-control @error('paypal_mode') is-invalid @enderror" id="paypal_mode" name="paypal_mode" value="{{ old('paypal_mode', env('PAYPAL_MODE')) }}">
            @error('paypal_mode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="paypal_sandbox_client_id">PayPal Client ID</label>
            <input type="text" class="form-control @error('paypal_sandbox_client_id') is-invalid @enderror" id="paypal_sandbox_client_id" name="paypal_sandbox_client_id" value="{{ old('paypal_sandbox_client_id', env('PAYPAL_SANDBOX_CLIENT_ID')) }}">
            @error('paypal_sandbox_client_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="paypal_sandbox_client_secret">PayPal Client Secret</label>
            <input type="text" class="form-control @error('paypal_sandbox_client_secret') is-invalid @enderror" id="paypal_sandbox_client_secret" name="paypal_sandbox_client_secret" value="{{ old('paypal_sandbox_client_secret', env('PAYPAL_SANDBOX_CLIENT_SECRET')) }}">
            @error('paypal_sandbox_client_secret')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Settings</button>
    </form>

@endsection
