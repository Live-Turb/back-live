@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Erro de Pagamento</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-circle text-danger" style="font-size: 48px;"></i>
                    </div>
                    <h5 class="card-title text-center">Não foi possível exibir o conteúdo</h5>
                    <p class="card-text text-center">{{ $message }}</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('billing.index') }}" class="btn btn-primary">
                            Regularizar Pagamento
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
