@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Painel de KPIs</h1>
        <div>
            <div class="btn-group" role="group">
                <button id="filter-day" class="btn btn-sm btn-outline-primary" data-period="day">Hoje</button>
                <button id="filter-week" class="btn btn-sm btn-outline-primary" data-period="week">Semana</button>
                <button id="filter-month" class="btn btn-sm btn-outline-primary active" data-period="month">Mês</button>
                <button id="filter-year" class="btn btn-sm btn-outline-primary" data-period="year">Ano</button>
            </div>
        </div>
    </div>

    <!-- Resumo de Métricas -->
    <div class="row mb-4">
        <!-- Total de Usuários -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Total de Usuários</h5>
                        <div class="icon-box bg-light-primary">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                    <h2 id="total-users-value" class="mb-1">Carregando...</h2>
                    <div class="d-flex align-items-center" id="total-users-change-container">
                        <span id="total-users-change" class="badge bg-success me-2">0%</span>
                        <small class="text-muted">vs período anterior</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Receita Total -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Receita Total</h5>
                        <div class="icon-box bg-light-success">
                            <i class="fas fa-dollar-sign text-success"></i>
                        </div>
                    </div>
                    <h2 id="total-revenue-value" class="mb-1">Carregando...</h2>
                    <div class="d-flex align-items-center">
                        <span id="revenue-trend" class="text-success me-2">
                            <i class="fas fa-arrow-up"></i> <span id="revenue-trend-value">0%</span>
                        </span>
                        <small class="text-muted">vs período anterior</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Taxa de Cancelamento -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Taxa de Cancelamento</h5>
                        <div class="icon-box bg-light-danger">
                            <i class="fas fa-times-circle text-danger"></i>
                        </div>
                    </div>
                    <h2 id="cancellation-rate-value" class="mb-1">Carregando...</h2>
                    <div class="d-flex align-items-center">
                        <span id="cancellation-trend" class="text-danger me-2">
                            <i class="fas fa-arrow-up"></i> <span id="cancellation-trend-value">0%</span>
                        </span>
                        <small class="text-muted">vs período anterior</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tempo Médio de Sessão -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Tempo Médio de Sessão</h5>
                        <div class="icon-box bg-light-info">
                            <i class="fas fa-clock text-info"></i>
                        </div>
                    </div>
                    <h2 id="average-session-time-value" class="mb-1">Carregando...</h2>
                    <div class="d-flex align-items-center">
                        <span id="session-trend" class="text-success me-2">
                            <i class="fas fa-arrow-up"></i> <span id="session-trend-value">0%</span>
                        </span>
                        <small class="text-muted">vs período anterior</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Principal -->
    <div class="row mb-4">
        <!-- Mapa de Distribuição Geográfica -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Distribuição Geográfica de Usuários</h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="realtime-toggle" checked>
                        <label class="form-check-label" for="realtime-toggle">Tempo Real</label>
                    </div>
                </div>
                <div class="card-body">
                    <div id="geographic-map" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Receita -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Receita por Período</h5>
                </div>
                <div class="card-body">
                    <div id="revenue-chart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Templates Ativos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Templates em Visualização Ativa</h5>
                    <span class="badge bg-primary" id="active-templates-count">Carregando...</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle" id="active-templates-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Template</th>
                                    <th>Tipo</th>
                                    <th>Criador</th>
                                    <th class="text-center">Visualizadores Ativos</th>
                                    <th class="text-center">Total de Visualizações</th>
                                    <th class="text-center">Última Visualização</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="d-flex align-items-center justify-content-center py-3">
                                            <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                                                <span class="visually-hidden">Carregando...</span>
                                            </div>
                                            <span>Carregando dados de templates ativos...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Dados atualizados em tempo real a cada 10 segundos
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos de Métricas Secundárias -->
    <div class="row mb-4">
        <!-- Tempo de Sessão -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Tempo de Sessão dos Usuários</h5>
                </div>
                <div class="card-body">
                    <div id="session-time-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Análise de Gastos -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Análise de Despesas</h5>
                    <a href="{{ route('admin.kpi.expenses') }}" class="btn btn-sm btn-outline-primary">Gerenciar</a>
                </div>
                <div class="card-body">
                    <div id="expenses-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Adicionais -->
    <div class="row">
        <!-- Taxa de Cancelamento -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Taxa de Cancelamento por Período</h5>
                </div>
                <div class="card-body">
                    <div id="cancellation-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Crescimento de Usuários -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Crescimento de Usuários</h5>
                </div>
                <div class="card-body">
                    <div id="user-growth-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.3.3/dist/css/jsvectormap.min.css" />
<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .card-header {
        font-weight: 600;
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 24px;
    }
    .bg-blue-light {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }
    .bg-green-light {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    .bg-red-light {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    .bg-cyan-light {
        background-color: rgba(13, 202, 240, 0.1);
        color: #0dcaf0;
    }
    .btn-group .btn.active {
        background-color: #0d6efd;
        color: white;
    }

    /* Estilos para os marcadores pulsantes no mapa */
    .pulse-container {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pulse-circle {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: rgba(13, 110, 253, 0.3);
        animation: pulse 2s infinite;
    }

    .pulse-count {
        position: relative;
        z-index: 2;
        background-color: #0d6efd;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            opacity: 0.7;
        }
        70% {
            transform: scale(1.2);
            opacity: 0.3;
        }
        100% {
            transform: scale(0.95);
            opacity: 0.7;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar os gráficos quando a página carregar
        getTotalUsers();
        getTotalRevenue();
        getSessionTimeAverage();
        getUsersGeographicData();
        getRevenueData();
        getSessionTimeData();
        getExpensesData();
        getCancellationRateData();
        getUserGrowthData();
        getActiveTemplates();

        // Atualizar templates ativos a cada 10 segundos
        setInterval(getActiveTemplates, 10000);

        // Adicionar eventos para os filtros de período
        document.querySelectorAll('.btn-group .btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remover classe active de todos os botões
                document.querySelectorAll('.btn-group .btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                // Adicionar classe active ao botão clicado
                this.classList.add('active');

                // Atualizar dados com base no período selecionado
                const period = this.dataset.period;
                getRevenueData(period);
                getSessionTimeData(period);
                getExpensesData(period);
                getCancellationRateData(period);
                getUserGrowthData(period);
            });
        });
    });

    // Funções para obter dados das APIs
    function getTotalUsers() {
        fetch('{{ route("admin.kpi.api.total-users") }}')
            .then(response => response.json())
            .then(data => {
                document.querySelector('#total-users-value').textContent = data.total_users;
                document.querySelector('#total-users-change').textContent = `${data.change_percentage}%`;

                // Adicionar classe baseada no valor da mudança
                const changeElement = document.querySelector('#total-users-change-container');
                if (data.change_percentage > 0) {
                    changeElement.classList.add('text-success');
                    changeElement.classList.remove('text-danger');
                } else if (data.change_percentage < 0) {
                    changeElement.classList.add('text-danger');
                    changeElement.classList.remove('text-success');
                }
            })
            .catch(error => {
                console.error('Erro ao carregar total de usuários:', error);
                document.querySelector('#total-users-value').textContent = 'Erro';
            });
    }

    function getTotalRevenue() {
        fetch('{{ route("admin.kpi.api.total-revenue") }}')
            .then(response => response.json())
            .then(data => {
                const revenueValue = data.total_revenue || 0;
                document.querySelector('#total-revenue-value').textContent = `R$ ${revenueValue.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;

                // Atualizar a tendência
                const trendElement = document.querySelector('#revenue-trend');
                const trendValueElement = document.querySelector('#revenue-trend-value');

                if (data.change_percentage !== undefined) {
                    const changePercentage = data.change_percentage;
                    trendValueElement.textContent = `${changePercentage}%`;

                    if (changePercentage > 0) {
                        trendElement.classList.add('text-success');
                        trendElement.classList.remove('text-danger');
                        trendElement.querySelector('i').classList.add('fa-arrow-up');
                        trendElement.querySelector('i').classList.remove('fa-arrow-down');
                    } else if (changePercentage < 0) {
                        trendElement.classList.add('text-danger');
                        trendElement.classList.remove('text-success');
                        trendElement.querySelector('i').classList.add('fa-arrow-down');
                        trendElement.querySelector('i').classList.remove('fa-arrow-up');
                    } else {
                        trendElement.classList.remove('text-success', 'text-danger');
                        trendElement.querySelector('i').classList.remove('fa-arrow-up', 'fa-arrow-down');
                    }
                }
            })
            .catch(error => {
                console.error('Erro ao carregar receita total:', error);
                document.querySelector('#total-revenue-value').textContent = 'R$ 0,00';
                document.querySelector('#revenue-trend-value').textContent = '0%';
            });
    }

    function getSessionTimeAverage() {
        fetch('{{ route("admin.kpi.api.total-session-time") }}')
            .then(response => response.json())
            .then(data => {
                if (data.total_time > 0) {
                    document.querySelector('#average-session-time-value').textContent = `${data.total_time.toFixed(1)} min`;
                } else {
                    document.querySelector('#average-session-time-value').textContent = '0 min';
                }
            })
            .catch(error => {
                console.error('Erro ao carregar tempo médio de sessão:', error);
                document.querySelector('#average-session-time-value').textContent = '0 min';
            });
    }

    function getUsersGeographicData() {
        // Verificar se o toggle de tempo real está ativado
        const isRealtime = document.querySelector('#realtime-toggle').checked;

        // Escolher a API com base no estado do toggle
        const apiUrl = isRealtime
            ? '{{ route("admin.kpi.api.users-online-geographic") }}'
            : '{{ route("admin.kpi.api.users-geographic") }}';

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                initializeMap(data, isRealtime);

                // Se estiver em tempo real, configurar atualização automática
                if (isRealtime) {
                    setTimeout(getUsersGeographicData, 10000); // Atualizar a cada 10 segundos
                }
            })
            .catch(error => {
                console.error('Erro ao carregar dados geográficos:', error);
                document.querySelector("#geographic-map").innerHTML = '<div class="alert alert-danger">Erro ao carregar mapa</div>';
            });
    }

    function getRevenueData(period = 'month') {
        fetch(`{{ route("admin.kpi.api.revenue") }}?period=${period}`)
            .then(response => response.json())
            .then(data => {
                if (!data || data.length === 0) {
                    document.querySelector("#revenue-chart").innerHTML = `
                        <div class="alert alert-warning m-0">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Nenhum dado de receita disponível para o período selecionado
                        </div>
                    `;
                    return;
                }
                initializeRevenueChart(data);
            })
            .catch(error => {
                console.error('Erro ao carregar dados de receita:', error);
                document.querySelector("#revenue-chart").innerHTML = `
                    <div class="alert alert-danger m-0">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Erro ao carregar dados de receita. Por favor, tente novamente.
                    </div>
                `;
            });
    }

    function getSessionTimeData(period = 'month') {
        fetch(`{{ route("admin.kpi.api.session-time") }}?period=${period}`)
            .then(response => response.json())
            .then(data => {
                if (!data || data.length === 0) {
                    document.querySelector("#session-time-chart").innerHTML = `
                        <div class="alert alert-warning m-0">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Nenhum dado de tempo de sessão disponível para o período selecionado
                        </div>
                    `;
                    return;
                }
                initializeSessionTimeChart(data);
            })
            .catch(error => {
                console.error('Erro ao carregar dados de tempo de sessão:', error);
                document.querySelector("#session-time-chart").innerHTML = `
                    <div class="alert alert-danger m-0">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Erro ao carregar dados de tempo de sessão. Por favor, tente novamente.
                    </div>
                `;
            });
    }

    function getExpensesData(period = 'month') {
        fetch(`{{ route("admin.kpi.api.expenses") }}?period=${period}`)
            .then(response => response.json())
            .then(data => {
                initializeExpensesChart(data);
            })
            .catch(error => {
                console.error('Erro ao carregar dados de despesas:', error);
                document.querySelector("#expenses-chart").innerHTML = '<div class="alert alert-danger">Erro ao carregar gráfico de despesas</div>';
            });
    }

    function getCancellationRateData(period = 'month') {
        fetch(`{{ route("admin.kpi.api.cancellation-rate") }}?period=${period}`)
            .then(response => response.json())
            .then(data => {
                initializeCancellationChart(data);
            })
            .catch(error => {
                console.error('Erro ao carregar dados de cancelamento:', error);
                document.querySelector("#cancellation-chart").innerHTML = '<div class="alert alert-danger">Erro ao carregar gráfico de cancelamento</div>';
            });
    }

    function getUserGrowthData(period = 'month') {
        fetch(`{{ route("admin.kpi.api.user-growth") }}?period=${period}`)
            .then(response => response.json())
            .then(data => {
                initializeUserGrowthChart(data);
            })
            .catch(error => {
                console.error('Erro ao carregar dados de crescimento:', error);
                document.querySelector("#user-growth-chart").innerHTML = '<div class="alert alert-danger">Erro ao carregar gráfico de crescimento</div>';
            });
    }

    // Funções de inicialização dos gráficos
    function initializeMap(data, isRealtime = false) {
        // Limpar o container
        const mapContainer = document.querySelector("#geographic-map");
        mapContainer.innerHTML = '';

        // Preparar dados para o mapa
        const mapData = {};
        data.forEach(item => {
            mapData[item.country.toLowerCase()] = item.total;
        });

        try {
            // Usar a versão correta do jsVectorMap
            const map = new jsVectorMap({
                selector: '#geographic-map',
                map: 'world',
                backgroundColor: 'transparent',
                zoomOnScroll: true,
                zoomButtons: true,
                series: {
                    regions: [{
                        values: mapData,
                        scale: ['#C8EEFF', '#0071A4'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                regionStyle: {
                    initial: {
                        fill: '#DCEEFF'
                    },
                    hover: {
                        fillOpacity: 0.7,
                        cursor: 'pointer'
                    }
                },
                onRegionTooltipShow: function(event, tooltip, code) {
                    if (mapData[code]) {
                        tooltip.text(tooltip.text() + ': ' + mapData[code] + ' usuários' + (isRealtime ? ' online' : ''));
                    } else {
                        tooltip.text(tooltip.text() + ': 0 usuários');
                    }
                }
            });

            // Adicionar marcadores pulsantes para países com usuários online
            if (isRealtime) {
                // Remover marcadores existentes
                const existingMarkers = mapContainer.querySelectorAll('.map-marker');
                existingMarkers.forEach(marker => marker.remove());

                // Adicionar novos marcadores
                setTimeout(() => {
                    data.forEach(item => {
                        const countryCode = item.country.toLowerCase();
                        const coords = map.getRegionCoords(countryCode);

                        if (coords && item.total > 0) {
                            const marker = document.createElement('div');
                            marker.className = 'map-marker';
                            marker.innerHTML = `
                                <div class="pulse-container">
                                    <div class="pulse-circle"></div>
                                    <div class="pulse-count">${item.total}</div>
                                </div>
                            `;

                            // Posicionar o marcador
                            marker.style.position = 'absolute';
                            marker.style.left = `${coords.x}px`;
                            marker.style.top = `${coords.y}px`;
                            marker.style.transform = 'translate(-50%, -50%)';
                            marker.style.zIndex = '1000';

                            mapContainer.appendChild(marker);
                        }
                    });
                }, 500); // Pequeno atraso para garantir que o mapa esteja renderizado
            }

            console.log('Mapa inicializado com sucesso');
        } catch (error) {
            console.error('Erro ao inicializar mapa:', error);
            mapContainer.innerHTML = '<div class="alert alert-danger">Erro ao inicializar mapa: ' + error.message + '</div>';
        }
    }

    function initializeRevenueChart(data) {
        // Limpar o container
        const chartContainer = document.querySelector("#revenue-chart");
        chartContainer.innerHTML = '';

        const dates = data.map(item => item.date);
        const values = data.map(item => parseFloat(item.revenue || 0));

        const options = {
            series: [{
                name: 'Receita',
                data: values
            }],
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: dates,
                type: 'datetime',
                labels: {
                    formatter: function(value) {
                        return new Date(value).toLocaleDateString('pt-BR');
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return 'R$ ' + value.toFixed(2).replace('.', ',');
                    }
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yyyy'
                },
                y: {
                    formatter: function(value) {
                        return 'R$ ' + value.toFixed(2).replace('.', ',');
                    }
                }
            },
            colors: ['#2E93fA']
        };

        try {
            // Limpar gráfico anterior se existir
            if (window.revenueChart) {
                window.revenueChart.destroy();
            }

            // Criar novo gráfico
            window.revenueChart = new ApexCharts(chartContainer, options);
            window.revenueChart.render();
        } catch (error) {
            console.error('Erro ao inicializar gráfico de receita:', error);
            chartContainer.innerHTML = `
                <div class="alert alert-danger m-0">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Erro ao inicializar gráfico de receita. Por favor, tente novamente.
                </div>
            `;
        }
    }

    function initializeSessionTimeChart(data) {
        // Limpar o container
        const chartContainer = document.querySelector("#session-time-chart");
        chartContainer.innerHTML = '';

        if (!data || data.length === 0) {
            chartContainer.innerHTML = `
                <div class="alert alert-warning m-0">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Nenhum dado de tempo de sessão disponível para o período selecionado
                </div>
            `;
            return;
        }

        const dates = data.map(item => item.date);
        const values = data.map(item => parseFloat(item.avg_duration || 0));

        const options = {
            series: [{
                name: 'Tempo de Sessão (min)',
                data: values
            }],
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: dates,
                type: 'datetime',
                labels: {
                    formatter: function(value) {
                        return new Date(value).toLocaleDateString('pt-BR');
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(1) + ' min';
                    }
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yyyy'
                },
                y: {
                    formatter: function(value) {
                        return value.toFixed(1) + ' minutos';
                    }
                }
            },
            colors: ['#2E93fA']
        };

        try {
            // Limpar gráfico anterior se existir
            if (window.sessionTimeChart) {
                window.sessionTimeChart.destroy();
            }

            // Criar novo gráfico
            window.sessionTimeChart = new ApexCharts(chartContainer, options);
            window.sessionTimeChart.render();
        } catch (error) {
            console.error('Erro ao inicializar gráfico de tempo de sessão:', error);
            chartContainer.innerHTML = `
                <div class="alert alert-danger m-0">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Erro ao inicializar gráfico de tempo de sessão. Por favor, tente novamente.
                </div>
            `;
        }
    }

    function initializeCancellationChart(data) {
        // Limpar o container
        const chartContainer = document.querySelector("#cancellation-chart");
        chartContainer.innerHTML = '';

        if (!data || data.length === 0) {
            chartContainer.innerHTML = '<div class="alert alert-warning">Sem dados de cancelamento para o período selecionado</div>';
            return;
        }

        const months = data.map(item => item.month);
        const rates = data.map(item => parseFloat(item.rate || 0));

        const options = {
            series: [{
                name: 'Taxa de Cancelamento',
                data: rates
            }],
            chart: {
                type: 'line',
                height: 300,
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true
                }
            },
            markers: {
                size: 5,
                colors: ['#F44336'],
                strokeWidth: 0,
                hover: {
                    size: 7
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            xaxis: {
                categories: months
            },
            yaxis: {
                title: {
                    text: 'Taxa (%)'
                },
                labels: {
                    formatter: function(value) {
                        return value.toFixed(1) + '%';
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toFixed(1) + '%';
                    }
                }
            },
            colors: ['#F44336']
        };

        try {
            // Limpar gráfico anterior se existir
            if (window.cancellationChart) {
                window.cancellationChart.destroy();
            }

            // Criar novo gráfico
            window.cancellationChart = new ApexCharts(chartContainer, options);
            window.cancellationChart.render();
            console.log('Gráfico de cancelamento inicializado com sucesso');
        } catch (error) {
            console.error('Erro ao inicializar gráfico de cancelamento:', error);
            chartContainer.innerHTML = '<div class="alert alert-danger">Erro ao inicializar gráfico de cancelamento</div>';
        }
    }

    function initializeExpensesChart(data) {
        // Limpar o container
        const chartContainer = document.querySelector("#expenses-chart");
        chartContainer.innerHTML = '';

        // Verificar se há dados
        if (!data || data.length === 0) {
            chartContainer.innerHTML = '<div class="alert alert-warning">Sem dados de despesas para o período selecionado</div>';
            return;
        }

        try {
            // Calcular o total para poder calcular as porcentagens
            const total = data.reduce((sum, item) => sum + parseFloat(item.total || 0), 0);

            if (total === 0) {
                chartContainer.innerHTML = '<div class="alert alert-warning">Nenhuma despesa com valor registrado no período</div>';
                return;
            }

            // Preparar os dados para o gráfico
            const categories = data.map(item => item.category);
            const values = data.map(item => parseFloat(item.total || 0));
            const percentages = values.map(value => Math.round((value / total) * 100));

            // Cores para as diferentes categorias
            const colors = [
                '#0A3D62', // azul escuro
                '#FF5252', // vermelho
                '#FF9800', // laranja
                '#00C853', // verde
                '#00B0FF', // azul claro
                '#9C27B0', // roxo
                '#607D8B'  // cinza
            ];

            const options = {
                series: values,
                chart: {
                    type: 'donut',
                    height: 300,
                    fontFamily: 'Poppins, sans-serif'
                },
                labels: categories,
                colors: colors,
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                name: {
                                    show: true
                                },
                                value: {
                                    show: true,
                                    formatter: function(val) {
                                        return 'R$ ' + parseFloat(val).toFixed(2).replace('.', ',');
                                    }
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function() {
                                        return 'R$ ' + total.toFixed(2).replace('.', ',');
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return 'R$ ' + parseFloat(value).toFixed(2).replace('.', ',') +
                                   ' (' + Math.round((value / total) * 100) + '%)';
                        }
                    }
                }
            };

            // Limpar gráfico anterior se existir
            if (window.expensesChart) {
                window.expensesChart.destroy();
            }

            // Criar e renderizar o gráfico
            window.expensesChart = new ApexCharts(chartContainer, options);
            window.expensesChart.render();

            // Adicionar legendas personalizadas após a renderização
            setTimeout(function() {
                const legendContainer = document.createElement('div');
                legendContainer.className = 'expense-legends mt-3';
                legendContainer.style.display = 'flex';
                legendContainer.style.flexWrap = 'wrap';
                legendContainer.style.justifyContent = 'center';

                data.forEach((item, index) => {
                    const legendItem = document.createElement('div');
                    legendItem.className = 'legend-item d-flex align-items-center me-3 mb-2';

                    const percent = percentages[index];
                    const color = colors[index % colors.length];

                    legendItem.innerHTML = `
                        <div class="legend-color me-1" style="width:12px; height:12px; background-color:${color}; border-radius:2px;"></div>
                        <div class="legend-text">
                            <div class="fw-bold">${percent}%</div>
                            <div class="small text-muted">${item.category}</div>
                        </div>
                    `;

                    legendContainer.appendChild(legendItem);
                });

                chartContainer.appendChild(legendContainer);
            }, 500);
        } catch (error) {
            console.error('Erro ao inicializar gráfico de despesas:', error);
            chartContainer.innerHTML = '<div class="alert alert-danger">Erro ao inicializar gráfico de despesas</div>';
        }
    }

    function initializeUserGrowthChart(data) {
        // Limpar o container
        const chartContainer = document.querySelector("#user-growth-chart");
        chartContainer.innerHTML = '';

        if (!data || data.length === 0) {
            chartContainer.innerHTML = '<div class="alert alert-warning">Sem dados de crescimento para o período selecionado</div>';
            return;
        }

        const months = data.map(item => item.month);
        const newUsers = data.map(item => parseInt(item.new_users || 0));

        const options = {
            series: [{
                name: 'Novos Usuários',
                data: newUsers
            }],
            chart: {
                type: 'bar',
                height: 300,
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    columnWidth: '60%',
                    distributed: true,
                    dataLabels: {
                        position: 'top'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return Math.round(val);
                },
                offsetX: 30,
                style: {
                    fontSize: '12px',
                    colors: ['#304758']
                }
            },
            xaxis: {
                categories: months
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value + ' usuários';
                    }
                }
            },
            colors: ['#3F51B5'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'vertical',
                    shadeIntensity: 0.3,
                    gradientToColors: undefined,
                    opacityFrom: 1,
                    opacityTo: 0.8,
                    stops: [0, 100]
                }
            }
        };

        try {
            if (window.userGrowthChart) {
                window.userGrowthChart.destroy();
            }

            window.userGrowthChart = new ApexCharts(chartContainer, options);
            window.userGrowthChart.render();
        } catch (error) {
            console.error('Erro ao inicializar gráfico de crescimento:', error);
            chartContainer.innerHTML = '<div class="alert alert-danger">Erro ao inicializar gráfico de crescimento</div>';
        }
    }

    // Função para obter e exibir templates ativos
    function getActiveTemplates() {
        console.log('Buscando templates ativos...');
        fetch('{{ route("admin.kpi.api.active-templates") }}')
            .then(response => response.json())
            .then(data => {
                console.log('Dados de templates ativos recebidos:', data);
                const tableBody = document.querySelector('#active-templates-table tbody');

                // Atualiza o contador - distinguindo entre ativos e recentes
                const activeCount = data.filter(t => !t.is_recent).length;
                const recentCount = data.filter(t => t.is_recent).length;

                if (activeCount > 0) {
                    document.querySelector('#active-templates-count').textContent = `${activeCount} ativos`;
                } else if (recentCount > 0) {
                    document.querySelector('#active-templates-count').textContent = `${recentCount} recentes`;
                } else {
                    document.querySelector('#active-templates-count').textContent = `0 ativos`;
                }

                if (data && data.length > 0) {
                    // Limpa a tabela
                    tableBody.innerHTML = '';

                    // Adiciona as linhas
                    data.forEach(template => {
                        const row = document.createElement('tr');

                        // Formata a data da última visualização
                        const lastViewedAt = new Date(template.last_view_at);
                        const formattedDate = `${lastViewedAt.toLocaleDateString()} ${lastViewedAt.toLocaleTimeString()}`;

                        // Determina o ícone com base no tipo de template
                        const templateIcon = template.template_type === 'instagram'
                            ? '<i class="fab fa-instagram text-danger"></i>'
                            : '<i class="fab fa-youtube text-danger"></i>';

                        // Determina a classe e mensagem para visualizadores ativos
                        const viewersBadgeClass = template.is_recent ? 'bg-secondary' : 'bg-primary';
                        const viewersCountLabel = template.is_recent ? 'Inativo' : template.active_viewers;

                        // Indicador visual para templates recentes vs ativos
                        const titleExtra = template.is_recent
                            ? '<span class="badge bg-warning text-dark ms-2">Recente</span>'
                            : '<span class="badge bg-success ms-2">Ativo</span>';

                        row.innerHTML = `
                            <td>
                                <div class="d-flex align-items-center">
                                    ${templateIcon}
                                    <span class="ms-2">${template.title} ${titleExtra}</span>
                                </div>
                            </td>
                            <td>${template.template_type === 'instagram' ? 'Instagram' : 'YouTube'}</td>
                            <td>${template.creator_name}</td>
                            <td class="text-center">
                                <span class="badge ${viewersBadgeClass} rounded-pill">
                                    <i class="fas fa-users me-1"></i> ${viewersCountLabel}
                                </span>
                            </td>
                            <td class="text-center">${template.total_views}</td>
                            <td class="text-center">${formattedDate}</td>
                            <td class="text-center">
                                <a href="${template.preview_url}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        `;

                        tableBody.appendChild(row);
                    });

                    // Adiciona efeito de atualização
                    tableBody.querySelectorAll('tr').forEach(row => {
                        row.style.animation = 'highlight-update 1s ease-out';
                    });
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-info m-0">
                                    <i class="fas fa-info-circle me-2"></i> Nenhum template ativo ou recente encontrado
                                </div>
                            </td>
                        </tr>
                    `;
                }
            })
            .catch(error => {
                console.error('Erro ao carregar templates ativos:', error);
                document.querySelector('#active-templates-table tbody').innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="alert alert-danger m-0">
                                <i class="fas fa-exclamation-circle me-2"></i> Erro ao carregar dados de templates ativos: ${error.message}
                            </div>
                        </td>
                    </tr>
                `;
            });
    }

    function getTotalSessionTime() {
        fetch('{{ route("admin.kpi.api.total-session-time") }}')
            .then(response => response.json())
            .then(data => {
                const sessionTimeValue = data.average_session_time || 0;
                document.querySelector('#session-time-value').textContent = `${sessionTimeValue} min`;

                // Atualizar a tendência
                const trendElement = document.querySelector('#session-time-trend');
                const trendValueElement = document.querySelector('#session-time-trend-value');

                if (data.change_percentage !== undefined) {
                    const changePercentage = data.change_percentage;
                    trendValueElement.textContent = `${changePercentage}%`;

                    if (changePercentage > 0) {
                        trendElement.classList.add('text-success');
                        trendElement.classList.remove('text-danger');
                        trendElement.querySelector('i').classList.add('fa-arrow-up');
                        trendElement.querySelector('i').classList.remove('fa-arrow-down');
                    } else if (changePercentage < 0) {
                        trendElement.classList.add('text-danger');
                        trendElement.classList.remove('text-success');
                        trendElement.querySelector('i').classList.add('fa-arrow-down');
                        trendElement.querySelector('i').classList.remove('fa-arrow-up');
                    } else {
                        trendElement.classList.remove('text-success', 'text-danger');
                        trendElement.querySelector('i').classList.remove('fa-arrow-up', 'fa-arrow-down');
                    }
                }
            })
            .catch(error => {
                console.error('Erro ao carregar tempo médio de sessão:', error);
                document.querySelector('#session-time-value').textContent = '0 min';
                document.querySelector('#session-time-trend-value').textContent = '0%';
            });
    }

    // Atualizar dados a cada 5 minutos
    setInterval(() => {
        getTotalSessionTime();
        getSessionTimeData(currentPeriod);
    }, 300000);
</script>
@endpush

@endsection
