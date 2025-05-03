@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Limite de Visualizações Excedido</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-chart-line fa-4x text-danger mb-3"></i>
                        <h5 class="font-weight-bold">VOCÊ ULTRAPASSOU TUDO!</h5>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <h6>Visualizações Totais</h6>
                            <h3>{{ number_format($current_views, 0, ',', '.') }}</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6>Visualizações Extras</h6>
                            <h3>{{ number_format($extra_views, 0, ',', '.') }}</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6>Valor Pendente</h6>
                            <h3 class="text-danger">R$ {{ number_format($pending_amount, 2, ',', '.') }}</h3>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <p class="mb-0">
                            <strong>Seu potencial deixou o Plano {{ $plan_name }} pra trás, e agora a RÉGUA SUBIU de vez pra você.</strong><br>
                            Esse limite não é mais suficiente pro seu nível. Tá na hora de desbloquear o que você realmente merece!
                        </p>
                    </div>

                    <div class="text-center mb-4">
                        <div class="btn-group">
                            <a href="{{ route('billing.payment') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card mr-2"></i>
                                Pagar Visualizações Extras
                            </a>
                            <a href="{{ route('billing.plans') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-arrow-up mr-2"></i>
                                Fazer Upgrade de Plano
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="text-center mt-3">
                        <p class="text-muted">
                            Precisa de ajuda? 
                            <a href="{{ route('support') }}">Entre em contato com nosso suporte</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
