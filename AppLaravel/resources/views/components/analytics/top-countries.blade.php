@props(['geoStats', 'totalViews'])

<div class="card shadow-sm">
    <div class="card-body">
        <h6 class="card-title text-muted mb-3">
            {{ __('analytics.top_countries') }}
            <span class="badge bg-primary rounded-pill ms-2" title="Acessos em tempo real">
                <i class="fas fa-globe"></i> {{ $totalViews ?? 0 }}
            </span>
        </h6>

        @if(isset($geoStats) && count($geoStats) > 0)
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('analytics.country') }}</th>
                            <th class="text-end">{{ __('analytics.views') }}</th>
                            <th class="text-end">{{ __('analytics.percentage') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($geoStats as $stat)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="country-flag-pulse me-2">
                                        <div class="country-flag-circle">
                                            <img src="{{ asset($stat['flag_path']) }}"
                                                alt="{{ $stat['country_name'] ?? $stat['country'] }}"
                                                class="flag-img"
                                                onerror="this.onerror=null; this.src='{{ asset('storage/bandeiras_mundo/xx.png') }}'">
                                        </div>
                                    </div>
                                    <span>{{ $stat['country_name'] ?? $stat['country'] }}</span>
                                </div>
                            </td>
                            <td class="text-end">
                                {{ number_format($stat['total'] ?? 0, 0, ',', '.') }}
                                <span class="badge bg-success rounded-pill ms-1 small" title="{{ __('analytics.unique_views_badge') }}">
                                    {{ number_format($stat['unique_views'] ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-end">
                                @if(isset($totalViews) && $totalViews > 0 && isset($stat['total']))
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="progress me-2" style="width: 40px; height: 6px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ ($stat['total'] / $totalViews) * 100 }}%"></div>
                                        </div>
                                        {{ number_format(($stat['total'] / $totalViews) * 100, 1, ',', '.') }}%
                                    </div>
                                @else
                                    0,0%
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-muted small text-center mt-2">
                <i class="fas fa-info-circle me-1"></i> {{ __('analytics.realtime_data') }}
                @if(request()->filled('video_id'))
                    {{ __('analytics.for_selected_video') }}
                @else
                    {{ __('analytics.for_all_videos') }}
                @endif
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> {{ __('analytics.no_geo_data') }}
                @if(request()->filled('video_id'))
                    <p class="small mt-2 mb-0">{{ __('analytics.no_views_different_regions') }}</p>
                @endif
            </div>
        @endif
    </div>
</div>

@push('scripts')
<style>
/* Estilos para as bandeiras dos países */
.country-flag-pulse {
    position: relative;
    display: inline-block;
}

.country-flag-circle {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    z-index: 1;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.1);
}

.country-flag-circle::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    border-radius: 50%;
    background: rgba(13, 110, 253, 0.2);
    z-index: -1;
    animation: pulse 2s infinite;
}

.flag-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@keyframes pulse {
    0% {
        transform: scale(0.95);
        opacity: 0.7;
    }
    70% {
        transform: scale(1.1);
        opacity: 0.3;
    }
    100% {
        transform: scale(0.95);
        opacity: 0.7;
    }
}

/* Efeito de atualização da tabela */
@keyframes highlight-update {
    0% { background-color: rgba(13, 110, 253, 0.1); }
    100% { background-color: transparent; }
}
.table-updated tr {
    animation: highlight-update 1s ease-out;
}
</style>

<script>
// Atualização automática a cada 10 segundos (reduzido de 30 para ter uma resposta mais rápida)
setInterval(function() {
    const currentVideo = '{{ request()->get("video_id") }}';
    fetch(`/analytics/dashboard?video_id=${currentVideo}&refresh=1`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.analytics && data.analytics.geo_stats) {
            // Atualiza o contador de visualizações totais
            const totalViewsCount = data.analytics.total_views || 0;
            document.querySelector('.card-title .badge').innerHTML = `<i class="fas fa-globe"></i> ${totalViewsCount}`;

            // Atualiza a tabela de países
            const geoStats = data.analytics.geo_stats;
            const tableBody = document.querySelector('table tbody');

            if (geoStats && geoStats.length > 0 && tableBody) {
                // Limpa a tabela existente
                tableBody.innerHTML = '';

                // Adiciona as novas linhas
                geoStats.forEach(stat => {
                    // Calcula a porcentagem
                    const percentage = totalViewsCount > 0
                        ? ((stat.total / totalViewsCount) * 100).toFixed(1)
                        : '0.0';

                    // Formata os números
                    const formattedTotal = new Intl.NumberFormat('pt-BR').format(stat.total || 0);
                    const formattedUnique = new Intl.NumberFormat('pt-BR').format(stat.unique_views || 0);

                    // Cria a nova linha
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="country-flag-pulse me-2">
                                    <div class="country-flag-circle">
                                        <img src="${stat.flag_path.startsWith('/') ? stat.flag_path : '/' + stat.flag_path}"
                                            alt="${stat.country_name || stat.country}"
                                            class="flag-img"
                                            onerror="this.onerror=null; this.src='{{ asset('storage/bandeiras_mundo/xx.png') }}'">
                                    </div>
                                </div>
                                <span>${stat.country_name || stat.country}</span>
                            </div>
                        </td>
                        <td class="text-end">
                            ${formattedTotal}
                            <span class="badge bg-success rounded-pill ms-1 small" title="{{ __('analytics.unique_views_badge') }}">
                                ${formattedUnique}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="progress me-2" style="width: 40px; height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: ${percentage}%"></div>
                                </div>
                                ${percentage}%
                            </div>
                        </td>
                    `;

                    tableBody.appendChild(row);
                });

                // Adiciona um efeito visual para indicar a atualização
                tableBody.classList.add('table-updated');
                setTimeout(() => {
                    tableBody.classList.remove('table-updated');
                }, 1000);

                console.log('Dados geográficos atualizados com sucesso!');
            } else if (tableBody) {
                // Se não houver dados, mostrar mensagem
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center">
                            <div class="alert alert-info m-0">
                                <i class="fas fa-info-circle me-2"></i> {{ __('analytics.no_geo_data') }}
                            </div>
                        </td>
                    </tr>
                `;
            }

            // Atualiza o timestamp de atualização
            const updatedAt = data.updated_at || new Date().toISOString();
            const timestampEl = document.querySelector('.text-muted.small.text-center.mt-2');
            if (timestampEl) {
                timestampEl.innerHTML = `<i class="fas fa-info-circle me-1"></i> {{ __('analytics.realtime_data') }}
                    (${new Date(updatedAt).toLocaleTimeString()})
                    @if(request()->filled('video_id'))
                        {{ __('analytics.for_selected_video') }}
                    @else
                        {{ __('analytics.for_all_videos') }}
                    @endif`;
            }
        }
    })
    .catch(error => console.error('Erro ao atualizar dados:', error));
}, 10000); // Atualiza a cada 10 segundos
</script>
@endpush
