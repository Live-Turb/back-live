@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Histórico de Cobranças</h4>
                </div>
                <div class="card-body">
                    @if($charges->isEmpty())
                        <div class="alert alert-info">
                            <p class="mb-0">Você ainda não possui cobranças registradas.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Período</th>
                                        <th>Visualizações</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($charges as $charge)
                                        <tr>
                                            <td>{{ $charge->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                {{ $charge->billing_period_start->format('d/m/Y') }} a 
                                                {{ $charge->billing_period_end->format('d/m/Y') }}
                                            </td>
                                            <td>{{ number_format($charge->extra_views, 0, ',', '.') }}</td>
                                            <td>R$ {{ number_format($charge->extra_views_cost, 2, ',', '.') }}</td>
                                            <td>
                                                @if($charge->status === 'pending')
                                                    <span class="badge bg-warning">Pendente</span>
                                                @elseif($charge->status === 'processed')
                                                    <span class="badge bg-success">Pago</span>
                                                @else
                                                    <span class="badge bg-danger">Falhou</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            {{ $charges->links() }}
                        </div>
                    @endif

                    <div class="alert alert-info mt-4">
                        <h5 class="alert-heading">Como funciona a cobrança?</h5>
                        <p>Você é cobrado automaticamente a cada {{ number_format(\App\Services\ViewTrackingService::EXTRA_VIEWS_BLOCK_SIZE, 0, ',', '.') }} visualizações extras.</p>
                        <p>O valor por visualização extra é de R$ {{ number_format(\App\Services\ViewTrackingService::EXTRA_VIEW_COST, 2, ',', '.') }}.</p>
                        <p>Você pode acumular até {{ number_format(\App\Services\ViewTrackingService::MAX_UNPAID_EXTRA_VIEWS, 0, ',', '.') }} visualizações extras não pagas antes que seu acesso seja bloqueado.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
