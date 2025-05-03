@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3">Detalhes da Cobrança</h1>
            <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <!-- Status da Cobrança -->
            <div class="mb-4">
                <span class="badge fs-6 p-2
                    @if($record->status === 'processed') bg-success
                    @elseif($record->status === 'failed') bg-danger
                    @else bg-warning @endif">
                    @if($record->status === 'processed')
                        Pago
                    @elseif($record->status === 'failed')
                        Falhou
                    @else
                        Pendente
                    @endif
                </span>
            </div>

            <!-- Informações Principais -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="h5 mb-4">Informações da Cobrança</h3>
                            <dl class="row">
                                <dt class="col-sm-4">ID da Cobrança</dt>
                                <dd class="col-sm-8">#{{ $record->id }}</dd>

                                <dt class="col-sm-4">Data da Cobrança</dt>
                                <dd class="col-sm-8">{{ $record->created_at->format('d/m/Y H:i') }}</dd>

                                <dt class="col-sm-4">Período</dt>
                                <dd class="col-sm-8">
                                    {{ $record->billing_period_start->format('d/m/Y') }} - 
                                    {{ $record->billing_period_end->format('d/m/Y') }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="h5 mb-4">Detalhes do Consumo</h3>
                            <dl class="row">
                                <dt class="col-sm-4">Total de Views</dt>
                                <dd class="col-sm-8">{{ number_format($record->total_views) }}</dd>

                                <dt class="col-sm-4">Views Extras</dt>
                                <dd class="col-sm-8">{{ number_format($record->extra_views) }}</dd>

                                <dt class="col-sm-4">Valor Total</dt>
                                <dd class="col-sm-8">
                                    <span class="fs-4 fw-bold text-primary">
                                        R$ {{ number_format($record->extra_views_cost, 2, ',', '.') }}
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informações de Pagamento -->
            @if($record->status === 'processed')
                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="h5 mb-4">Informações do Pagamento</h3>
                        @php
                            $notes = json_decode($record->notes);
                        @endphp
                        <dl class="row">
                            @if(isset($notes->payment_intent_id))
                                <dt class="col-sm-3">ID do Pagamento</dt>
                                <dd class="col-sm-9">{{ $notes->payment_intent_id }}</dd>
                            @endif
                            @if(isset($notes->processed_at))
                                <dt class="col-sm-3">Data do Processamento</dt>
                                <dd class="col-sm-9">
                                    {{ \Carbon\Carbon::parse($notes->processed_at)->format('d/m/Y H:i:s') }}
                                </dd>
                            @endif
                            @if(isset($notes->amount))
                                <dt class="col-sm-3">Valor Pago</dt>
                                <dd class="col-sm-9">
                                    R$ {{ number_format($notes->amount, 2, ',', '.') }}
                                    @if(isset($notes->currency))
                                        <small class="text-muted">({{ strtoupper($notes->currency) }})</small>
                                    @endif
                                </dd>
                            @endif
                        </dl>
                    </div>
                </div>
            @elseif($record->status === 'failed')
                <div class="card mt-4 border-danger">
                    <div class="card-body">
                        <h3 class="h5 mb-4 text-danger">Detalhes do Erro</h3>
                        @php
                            $notes = json_decode($record->notes);
                        @endphp
                        <dl class="row">
                            @if(isset($notes->error))
                                <dt class="col-sm-3">Mensagem de Erro</dt>
                                <dd class="col-sm-9 text-danger">{{ $notes->error }}</dd>
                            @endif
                            @if(isset($notes->failed_at))
                                <dt class="col-sm-3">Data da Falha</dt>
                                <dd class="col-sm-9">
                                    {{ \Carbon\Carbon::parse($notes->failed_at)->format('d/m/Y H:i:s') }}
                                </dd>
                            @endif
                        </dl>
                    </div>
                </div>
            @else
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="h5 mb-0">Pagamento Pendente</h3>
                            <button type="button" class="btn btn-primary" onclick="startPayment()">
                                <i class="fas fa-credit-card me-1"></i> Processar Pagamento
                            </button>
                        </div>
                        <p class="text-muted">
                            Esta cobrança está pendente de processamento. Clique no botão acima para processá-la agora.
                        </p>
                    </div>
                </div>

                <!-- Modal de Pagamento -->
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Pagamento de Visualizações Extras</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-info mb-3">
                                    <p class="mb-1"><strong>Visualizações Extras:</strong> {{ number_format($record->extra_views) }}</p>
                                    <p class="mb-0"><strong>Valor Total:</strong> R$ {{ number_format($record->extra_views_cost, 2, ',', '.') }}</p>
                                </div>
                                <div id="payment-element"></div>
                                <div id="payment-message" class="alert mt-3" style="display: none;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" id="submit-payment">
                                    <span id="button-text">Pagar Agora</span>
                                    <span id="spinner" class="spinner-border spinner-border-sm" role="status" style="display: none;"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://js.stripe.com/v3/"></script>
                <script>
                let stripe;
                let elements;

                async function startPayment() {
                    try {
                        // Processa a cobrança e obtém o client secret
                        const response = await fetch('{{ route("billing.process-charge", $record->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        const data = await response.json();
                        
                        if (!data.success) {
                            throw new Error(data.error || 'Erro ao processar cobrança');
                        }

                        // Mostra o modal
                        const myModal = new bootstrap.Modal(document.getElementById('paymentModal'));
                        myModal.show();

                        // Inicializa o Stripe
                        stripe = Stripe('{{ config("services.stripe.key") }}');
                        elements = stripe.elements({
                            clientSecret: data.client_secret,
                            appearance: {
                                theme: 'stripe'
                            }
                        });

                        const paymentElement = elements.create('payment');
                        paymentElement.mount('#payment-element');

                        // Configura o botão de pagamento
                        document.querySelector('#submit-payment').addEventListener('click', async () => {
                            setLoading(true);
                            
                            try {
                                const { error } = await stripe.confirmPayment({
                                    elements,
                                    confirmParams: {
                                        return_url: '{{ route("billing.confirm") }}',
                                    },
                                });

                                if (error) {
                                    showMessage(error.message, 'error');
                                }
                            } catch (e) {
                                showMessage('Ocorreu um erro ao processar o pagamento.', 'error');
                            }

                            setLoading(false);
                        });

                    } catch (error) {
                        console.error('Erro:', error);
                        alert('Erro ao iniciar o pagamento: ' + error.message);
                    }
                }

                function showMessage(messageText, type = 'error') {
                    const messageElement = document.querySelector('#payment-message');
                    messageElement.classList.remove('alert-success', 'alert-danger');
                    messageElement.classList.add(type === 'error' ? 'alert-danger' : 'alert-success');
                    messageElement.textContent = messageText;
                    messageElement.style.display = 'block';
                }

                function setLoading(isLoading) {
                    const submitButton = document.querySelector('#submit-payment');
                    const spinner = document.querySelector('#spinner');
                    const buttonText = document.querySelector('#button-text');

                    if (isLoading) {
                        submitButton.disabled = true;
                        spinner.style.display = 'inline-block';
                        buttonText.style.display = 'none';
                    } else {
                        submitButton.disabled = false;
                        spinner.style.display = 'none';
                        buttonText.style.display = 'inline-block';
                    }
                }
                </script>
            @endif
        </div>
    </div>
</div>
@endsection
