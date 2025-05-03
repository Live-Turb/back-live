@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ __('billing.extra_views_payment') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-md-4">
                            <h6>{{ __('billing.total_views') }}</h6>
                            <h4>{{ number_format($current_month_views, 0, ',', '.') }}</h4>
                            <small class="text-muted">{{ __('billing.this_month') }}</small>
                        </div>
                        <div class="col-md-4">
                            <h6>{{ __('billing.extra_views') }}</h6>
                            <h4 class="text-warning">{{ number_format($total_extra_views, 0, ',', '.') }}</h4>
                            <small class="text-muted">{{ __('billing.above_limit', ['limit' => number_format($basic_plan_views, 0, ',', '.')]) }}</small>
                        </div>
                        <div class="col-md-4">
                            <h6>{{ __('billing.amount') }}</h6>
                            <h4 class="text-danger">R$ {{ number_format($total_amount, 2, ',', '.') }}</h4>
                            <small class="text-muted">{{ __('billing.pending') }}</small>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h5 class="alert-heading">
                            <i class="fas fa-info-circle mr-2"></i>
                            {{ __('billing.charges_details') }}
                        </h5>
                        <p class="mb-0">
                            {{ __('billing.plan_includes', ['limit' => number_format($basic_plan_views, 0, ',', '.')]) }}
                            {{ __('billing.cost_per_block', ['cost' => '10,00', 'block' => '500']) }}
                        </p>
                    </div>

                    @if($pending_charges->count() > 0)
                        <div class="table-responsive mb-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('billing.date') }}</th>
                                        <th>{{ __('billing.views') }}</th>
                                        <th>{{ __('billing.amount') }}</th>
                                        <th>{{ __('billing.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pending_charges as $charge)
                                        <tr>
                                            <td>{{ $charge->created_at->format('d/m/Y') }}</td>
                                            <td>{{ number_format($charge->extra_views, 0, ',', '.') }}</td>
                                            <td>R$ {{ number_format($charge->extra_views_cost, 2, ',', '.') }}</td>
                                            <td>
                                                <span class="badge badge-warning">{{ __('billing.pending') }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('billing.payment_method') }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment_method" id="credit_card" checked>
                                            <label class="form-check-label" for="credit_card">
                                                <i class="fas fa-credit-card mr-2"></i>
                                                {{ __('billing.credit_card') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment_method" id="pix">
                                            <label class="form-check-label" for="pix">
                                                <i class="fas fa-qrcode mr-2"></i>
                                                PIX
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div id="credit_card_form">
                                    <div class="form-group">
                                        <label>{{ __('billing.card_number') }}</label>
                                        <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('billing.expiry_date') }}</label>
                                                <input type="text" class="form-control" placeholder="MM/AA">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('billing.cvv') }}</label>
                                                <input type="text" class="form-control" placeholder="123">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('billing.card_holder') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ __('billing.card_holder_placeholder') }}">
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block mt-4">
                                    <i class="fas fa-lock mr-2"></i>
                                    {{ __('billing.pay_now') }} {{ 'R$ ' . number_format($total_amount, 2, ',', '.') }}
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <h5 class="alert-heading">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ __('billing.no_pending_charges') }}
                            </h5>
                            <p class="mb-0">
                                {{ __('billing.no_pending_message') }}
                            </p>
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        <p class="text-muted">
                            {{ __('billing.questions_about_charges') }} 
                            <a href="{{ route('support') }}">{{ __('billing.contact_support') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('input[name="payment_method"]').change(function() {
        if ($(this).attr('id') === 'credit_card') {
            $('#credit_card_form').show();
        } else {
            $('#credit_card_form').hide();
        }
    });
});
</script>
@endpush
