@extends('layouts.clean')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-gradient-premium text-white">
                    <h4 class="mb-0">Limite de Visualizações Excedido</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/sitelogo/liveturb-topo.png') }}" alt="LiveTurb" class="logo-img">
                        <h5 class="font-weight-bold">Você está pronto para o próximo nível!</h5>
                    </div>

                    <div class="stats-container">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="lock-overlay">
                                    <h6>Visualizações Totais</h6>
                                    <h4 class="blur-content">{{ number_format($current_views, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="lock-overlay">
                                    <h6>Visualizações Extras</h6>
                                    <h4 class="blur-content text-warning">{{ number_format($extra_views, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="lock-overlay">
                                    <h6>Valor Pendente</h6>
                                    <h4 class="blur-content text-danger">R$ {{ number_format($pending_amount, 2, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-primary">
                        <p class="mb-0">
                            <i class="fas fa-star mr-2"></i>
                            <strong>VOCÊ ULTRAPASSOU TUDO!</strong>
                        </p>
                        <p class="mb-0 mt-2">
                            Seu potencial deixou o Plano 
                            <span class="lock-overlay">
                                <span class="blur-content">PREMIUM</span>
                            </span> 
                            pra trás, e agora a RÉGUA SUBIU de vez pra você.
                        </p>
                        <p class="mb-0 mt-2">
                            Esse limite não é mais suficiente pro seu nível. 
                            Tá na hora de desbloquear o que você realmente merece!
                        </p>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('billing.payment') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-credit-card mr-2"></i>
                            Realizar Pagamento
                        </a>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Previne seleção de texto nos elementos borrados
    document.querySelectorAll('.blur-content').forEach(function(el) {
        el.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    });
});
</script>
@endpush
@endsection
