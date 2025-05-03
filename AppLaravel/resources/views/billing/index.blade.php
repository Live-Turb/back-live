@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-chart-line text-primary me-2"></i>
            {{ __('billing.monthly_views') }} - 
            <span class="badge bg-primary">{{ $viewsInfo['plan_name'] }}</span>
        </h2>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                <div class="card-body text-center p-4">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-eye fa-2x text-primary"></i>
                    </div>
                    <h3 class="card-title h5 mb-3">{{ __('billing.total_views') }}</h3>
                    <p class="h3 text-primary mb-0 counter-animation">{{ number_format($viewsInfo['total_views'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                <div class="card-body text-center p-4">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-chart-bar fa-2x text-success"></i>
                    </div>
                    <h3 class="card-title h5 mb-3">{{ __('billing.plan_limit') }}</h3>
                    <p class="h3 text-success mb-0 counter-animation">{{ number_format($viewsInfo['plan_views_limit'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                <div class="card-body text-center p-4">
                    <div class="icon-wrapper mb-3">
                        @if($viewsInfo['extra_views'] > 0)
                            <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                        @else
                            <i class="fas fa-check-circle fa-2x text-info"></i>
                        @endif
                    </div>
                    <h3 class="card-title h5 mb-3">
                        @if($viewsInfo['extra_views'] > 0)
                            {{ __('billing.extra_views') }}
                        @else
                            {{ __('billing.remaining_views') }}
                        @endif
                    </h3>
                    @if($viewsInfo['extra_views'] > 0)
                        <p class="h3 text-warning mb-0 counter-animation">{{ number_format($viewsInfo['extra_views'], 0, ',', '.') }}</p>
                    @else
                        <p class="h3 text-info mb-0 counter-animation">{{ number_format($viewsInfo['remaining_views'], 0, ',', '.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="h5 mb-3">
                <i class="fas fa-tasks text-primary me-2"></i>
                {{ __('billing.views_usage') }}
            </h4>
            @php
                $usagePercentage = ($viewsInfo['total_views'] / $viewsInfo['plan_views_limit']) * 100;
                $progressClass = $usagePercentage >= 100 ? 'bg-danger' : ($usagePercentage >= 80 ? 'bg-warning' : 'bg-success');
            @endphp
            <div class="progress" style="height: 20px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $progressClass }}" 
                     role="progressbar" 
                     style="width: {{ min($usagePercentage, 100) }}%"
                     aria-valuenow="{{ $viewsInfo['total_views'] }}" 
                     aria-valuemin="0" 
                     aria-valuemax="{{ $viewsInfo['plan_views_limit'] }}">
                    {{ number_format($usagePercentage, 1) }}%
                </div>
            </div>
        </div>
    </div>

    @if($viewsInfo['extra_views'] > 0 && $viewsInfo['show_payment_button'])
        <div class="alert alert-warning border-0 shadow-sm mb-4">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                </div>
                <div class="flex-grow-1">
                    <h3 class="h5 mb-2">{{ __('billing.extra_views_alert_title') }}</h3>
                    <p class="mb-2">
                        {{ __('billing.extra_views_alert_message', [
                            'count' => number_format($viewsInfo['extra_views'], 0, ',', '.'),
                            'cost' => number_format($viewsInfo['extra_view_cost'], 2, ',', '.')
                        ]) }}
                    </p>
                    <p class="mb-2">
                        <strong>{{ __('billing.total_cost', ['amount' => number_format($viewsInfo['extra_cost'], 2, ',', '.')]) }}</strong>
                    </p>
                    <button class="btn btn-warning mt-2" onclick="showPaymentModal()">
                        <i class="fas fa-credit-card me-2"></i>
                        {{ __('billing.pay_now') }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white p-4 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-history text-primary me-2"></i>
                    {{ __('billing.billing_history') }}
                </h3>
                @if($viewsInfo['total_paid_views'] > 0)
                    <button type="button" class="btn btn-outline-primary" onclick="showPaidViews()">
                        <i class="fas fa-list-alt me-2"></i>
                        {{ __('billing.view_paid_views') }}
                    </button>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">{{ __('billing.date') }}</th>
                            <th class="px-4 py-3">{{ __('billing.description') }}</th>
                            <th class="px-4 py-3">{{ __('billing.views') }}</th>
                            <th class="px-4 py-3">{{ __('billing.amount') }}</th>
                            <th class="px-4 py-3">{{ __('billing.status') }}</th>
                            <th class="px-4 py-3">{{ __('billing.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($billingRecords as $record)
                            <tr class="align-middle">
                                <td class="px-4 py-3">
                                    <i class="far fa-calendar-alt text-muted me-2"></i>
                                    {{ $record->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $record->description ?? ($record->notes ?? __('billing.extra_views_payment')) }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary">
                                        {{ number_format($record->extra_views, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <strong class="text-success">
                                        R$ {{ number_format($record->amount ?? $record->extra_views_cost, 2, ',', '.') }}
                                    </strong>
                                </td>
                                <td class="px-4 py-3">
                                    @if($record->status === 'processed')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            {{ __('billing.paid') }}
                                        </span>
                                    @elseif($record->status === 'pending')
                                        <span class="badge bg-warning">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ __('billing.pending') }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>
                                            {{ __('billing.failed') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="showPaidViews('{{ $record->id }}')">
                                            <i class="fas fa-eye me-1"></i>
                                            {{ __('billing.details') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    {{ __('billing.no_records_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($billingRecords->hasPages())
            <div class="card-footer bg-white border-0 p-4">
                {{ $billingRecords->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">{{ __('billing.extra_views_payment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('billing.close') }}"></button>
            </div>
            <div class="modal-body">
                <div id="payment-form">
                    <div class="mb-3">
                        <label class="form-label">{{ __('billing.payment_method') }}</label>
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary active" onclick="selectPaymentMethod('credit_card')">
                                <i class="fas fa-credit-card"></i> {{ __('billing.credit_card') }}
                            </button>
                            <button type="button" class="btn btn-outline-primary" onclick="selectPaymentMethod('mercado_pago')">
                                <i class="fas fa-money-bill"></i> {{ __('billing.mercado_pago') }}
                            </button>
                        </div>
                    </div>

                    <div id="credit-card-form">
                        <div class="mb-3">
                            <label class="form-label">{{ __('billing.card_number') }}</label>
                            <input type="text" class="form-control" id="card-number">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('billing.expiry_date') }}</label>
                                <input type="text" class="form-control" id="card-expiry">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('billing.cvv') }}</label>
                                <input type="text" class="form-control" id="card-cvv">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('billing.card_holder') }}</label>
                            <input type="text" class="form-control" id="card-holder">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('billing.cancel') }}</button>
                <button type="button" class="btn btn-primary" onclick="processPayment()">{{ __('billing.process_payment') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Visualizações Pagas -->
<div class="modal fade" id="paidViewsModal" tabindex="-1" aria-labelledby="paidViewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paidViewsModalLabel">{{ __('billing.paid_views') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>{{ __('billing.total_paid_views') }}</strong></p>
                            <h4 id="total-paid-views">0</h4>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>{{ __('billing.total_paid_amount') }}</strong></p>
                            <h4 id="total-paid-amount">R$ 0,00</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="paid-views-table">
                        <thead>
                            <tr>
                                <th>{{ __('billing.date') }}</th>
                                <th>{{ __('billing.description') }}</th>
                                <th>{{ __('billing.views') }}</th>
                                <th>{{ __('billing.amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('billing.close') }}</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
.transition-all {
    transition: all 0.3s ease;
}
.icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(var(--bs-primary-rgb), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}
.counter-animation {
    opacity: 0;
    animation: fadeInUp 0.5s ease forwards;
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.table > :not(caption) > * > * {
    border-bottom-width: 1px;
}
.table > tbody > tr:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}
.pagination {
    margin-bottom: 0;
}
</style>
@endpush

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate counters
    const counters = document.querySelectorAll('.counter-animation');
    counters.forEach(counter => {
        counter.style.opacity = 1;
    });

    // Inicializar tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

function showPaymentModal(recordId = null, amount = null) {
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    if (recordId && amount) {
        document.getElementById('payment-record-id').value = recordId;
        document.getElementById('payment-amount').textContent = `R$ ${amount.toFixed(2)}`;
    }
    modal.show();
}

function selectPaymentMethod(method) {
    const buttons = document.querySelectorAll('.payment-method-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    
    const selectedBtn = document.querySelector(`[data-method="${method}"]`);
    if (selectedBtn) selectedBtn.classList.add('active');
    
    const creditCardForm = document.getElementById('credit-card-form');
    creditCardForm.style.display = method === 'credit_card' ? 'block' : 'none';
}

function showPaidViews(recordId = null) {
    const modal = new bootstrap.Modal(document.getElementById('paidViewsModal'));
    modal.show();
    
    // Carregar dados via AJAX
    fetch(`/billing/paid-views${recordId ? `?record_id=${recordId}` : ''}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updatePaidViewsModal(data.data);
            } else {
                console.error('Erro ao carregar visualizações pagas:', data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao carregar visualizações pagas:', error);
        });
}

function updatePaidViewsModal(data) {
    // Atualizar totais
    document.getElementById('total-paid-views').textContent = data.total_views.toLocaleString('pt-BR');
    document.getElementById('total-paid-amount').textContent = `R$ ${data.total_amount.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    })}`;
    
    // Atualizar tabela
    const tbody = document.querySelector('#paid-views-table tbody');
    tbody.innerHTML = '';
    
    data.records.forEach(record => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${new Date(record.date).toLocaleDateString('pt-BR')}</td>
            <td>${record.description}</td>
            <td>${record.views.toLocaleString('pt-BR')}</td>
            <td>R$ ${record.amount.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}</td>
        `;
        tbody.appendChild(row);
    });
}

// Stripe Payment Processing
let stripe = Stripe('{{ config('services.stripe.key') }}');
let elements = stripe.elements();

// Criar elementos do Stripe
let card = elements.create('card');
card.mount('#card-element');

function processPayment() {
    const submitButton = document.querySelector('#process-payment-btn');
    submitButton.disabled = true;
    submitButton.textContent = '{{ __('billing.processing') }}...';

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            showError(result.error.message);
            submitButton.disabled = false;
            submitButton.textContent = '{{ __('billing.process_payment') }}';
        } else {
            stripeTokenHandler(result.token);
        }
    });
}

function stripeTokenHandler(token) {
    const form = document.getElementById('payment-form');
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    fetch('/billing/process-payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            token: token.id,
            record_id: document.getElementById('payment-record-id').value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccess(data.message);
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        showError('{{ __('billing.payment_error') }}');
    })
    .finally(() => {
        const submitButton = document.querySelector('#process-payment-btn');
        submitButton.disabled = false;
        submitButton.textContent = '{{ __('billing.process_payment') }}';
    });
}

function showError(message) {
    const errorDiv = document.getElementById('payment-errors');
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
}

function showSuccess(message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'alert alert-success';
    successDiv.textContent = message;
    document.getElementById('payment-form').prepend(successDiv);
}
</script>
@endpush
