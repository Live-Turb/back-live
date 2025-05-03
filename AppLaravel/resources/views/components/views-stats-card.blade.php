@props(['viewsUsed', 'viewsLimit', 'extraViews'])

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Consumo de Visualizações</h5>
            <a href="{{ route('analytics.views') }}" class="text-primary text-decoration-none">
                <small>Ver Detalhes</small>
            </a>
        </div>
        
        @php
            $percentage = ($viewsUsed / $viewsLimit) * 100;
            $remaining = $viewsLimit - $viewsUsed;
            $progressColor = $percentage > 90 ? 'danger' : ($percentage > 70 ? 'warning' : 'primary');
        @endphp

        <div class="views-stats">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">{{ number_format($viewsUsed) }} usadas</span>
                <span class="text-muted">{{ number_format($viewsLimit) }} disponíveis</span>
            </div>
            
            <div class="progress mb-3" style="height: 10px;">
                <div class="progress-bar bg-{{ $progressColor }}" 
                     role="progressbar" 
                     style="width: {{ $percentage }}%" 
                     aria-valuenow="{{ $percentage }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block text-muted mb-1">Restantes</span>
                    <h4 class="mb-0 fw-bold">{{ number_format($remaining) }}</h4>
                </div>
                @if($extraViews > 0)
                    <div class="text-end">
                        <span class="d-block text-muted mb-1">Visualizações Extras</span>
                        <h4 class="mb-0 text-danger fw-bold">+{{ number_format($extraViews) }}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
