@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Estatísticas Gerais -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Total de Visualizações -->
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-1">Total de Visualizações</h6>
                                <h3 class="mb-0">{{ number_format($totalViews) }}</h3>
                            </div>
                        </div>
                        
                        <!-- Visualizações Restantes -->
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-1">Visualizações Restantes</h6>
                                <h3 class="mb-0">{{ number_format($remainingViews) }}</h3>
                            </div>
                        </div>
                        
                        <!-- Visualizações Extras -->
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-1">Visualizações Extras</h6>
                                <h3 class="mb-0 {{ $extraViews > 0 ? 'text-danger' : '' }}">
                                    {{ $extraViews > 0 ? '+' : '' }}{{ number_format($extraViews) }}
                                </h3>
                            </div>
                        </div>
                        
                        <!-- Custo Estimado Extra -->
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-1">Custo Extra Estimado</h6>
                                <h3 class="mb-0 {{ $extraCost > 0 ? 'text-danger' : '' }}">
                                    R$ {{ number_format($extraCost, 2, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Consumo -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Consumo de Visualizações</h5>
                    <canvas id="viewsChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Templates mais visualizados -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Templates Mais Visualizados</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Template</th>
                                    <th>Visualizações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topTemplates as $template)
                                <tr>
                                    <td>{{ $template->name }}</td>
                                    <td>{{ number_format($template->views_count) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histórico de Visualizações -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Histórico de Visualizações</h5>
                    <div class="table-responsive">
                        <table class="table" id="viewsHistoryTable">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Template</th>
                                    <th>Visualizações</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewsHistory as $record)
                                <tr>
                                    <td>{{ $record->date->format('d/m/Y') }}</td>
                                    <td>{{ $record->template_name }}</td>
                                    <td>{{ number_format($record->views_count) }}</td>
                                    <td>
                                        @if($record->is_extra)
                                            <span class="badge bg-danger">Extra</span>
                                        @else
                                            <span class="badge bg-success">Incluído</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar DataTable
    $('#viewsHistoryTable').DataTable({
        order: [[0, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        }
    });

    // Configurar gráfico
    const ctx = document.getElementById('viewsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Visualizações',
                data: @json($chartData['data']),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush
