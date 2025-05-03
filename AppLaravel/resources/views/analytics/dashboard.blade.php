@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('components.analytics.advanced-filters')

    <!-- Overview Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.total_views') }}</h6>
                    <h2 class="mb-2 fw-bold">{{ number_format($analytics['total_views']) }}</h2>
                    <small class="text-muted">
                        @if($analytics['period_comparison']['percentage_change'] > 0)
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 
                                +{{ number_format($analytics['period_comparison']['percentage_change'], 1) }}%
                            </span>
                        @else
                            <span class="text-danger">
                                <i class="fas fa-arrow-down"></i> 
                                {{ number_format($analytics['period_comparison']['percentage_change'], 1) }}%
                            </span>
                        @endif
                        {{ __('analytics.vs_previous_period') }}
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.unique_views') }}</h6>
                    <h2 class="mb-2 fw-bold">{{ number_format($analytics['unique_views']) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.engagement_rate') }}</h6>
                    <h2 class="mb-2 fw-bold">
                        {{ $analytics['total_views'] > 0 
                            ? number_format(($analytics['unique_views'] / $analytics['total_views']) * 100, 1) 
                            : 0 }}%
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.daily_average') }}</h6>
                    <h2 class="mb-2 fw-bold">
                        {{ number_format($analytics['total_views'] / $period, 1) }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.views_over_time') }}</h6>
                    <div style="position: relative; height: 300px;">
                        <canvas id="viewsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.device_breakdown') }}</h6>
                    <div style="position: relative; height: 300px;">
                        <canvas id="deviceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Charts Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.hourly_breakdown') }}</h6>
                    <div style="position: relative; height: 300px;">
                        <canvas id="hourlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <x-analytics.top-countries :geoStats="$analytics['geo_stats']" :totalViews="$analytics['total_views']" />
        </div>
    </div>

    <!-- Details Tables -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.top_browsers') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('analytics.browser') }}</th>
                                    <th class="text-end">{{ __('analytics.views') }}</th>
                                    <th class="text-end">{{ __('analytics.percentage') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($analytics['browser_stats'] as $browser)
                                <tr>
                                    <td>{{ $browser->browser }}</td>
                                    <td class="text-end">{{ number_format($browser->count) }}</td>
                                    <td class="text-end">{{ number_format(($browser->count / $analytics['total_views']) * 100, 1) }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">{{ __('analytics.top_referrers') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('analytics.referrer') }}</th>
                                    <th class="text-end">{{ __('analytics.views') }}</th>
                                    <th class="text-end">{{ __('analytics.percentage') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($analytics['top_referrers'] as $referrer)
                                <tr>
                                    <td>{{ $referrer->referrer_domain ?? 'Direto' }}</td>
                                    <td class="text-end">{{ number_format($referrer->count) }}</td>
                                    <td class="text-end">{{ number_format(($referrer->count / $analytics['total_views']) * 100, 1) }}%</td>
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
<script>
$(document).ready(function() {
    try {
        // Views Over Time Chart
        new Chart(document.getElementById('viewsChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($analytics['views_by_day']->toArray(), 'date')) !!},
                datasets: [{
                    label: '{{ __('analytics.total') }}',
                    data: {!! json_encode(array_column($analytics['views_by_day']->toArray(), 'total')) !!},
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#4e73df',
                    fill: true,
                    tension: 0.4
                }, {
                    label: '{{ __('analytics.unique') }}',
                    data: {!! json_encode(array_column($analytics['views_by_day']->toArray(), 'unique')) !!},
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28, 200, 138, 0.1)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#1cc88a',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Device Chart
        const deviceLabels = {
            'mobile': '{{ __('analytics.mobile') }}',
            'desktop': '{{ __('analytics.desktop') }}',
            'tablet': '{{ __('analytics.tablet') }}'
        };

        const deviceColors = {
            'mobile': '#4e73df',
            'desktop': '#1cc88a',
            'tablet': '#36b9cc'
        };

        const deviceData = {!! json_encode($analytics['device_breakdown']) !!};
        const deviceChartData = {
            labels: Object.keys(deviceData).map(key => deviceLabels[key] || key),
            datasets: [{
                data: Object.values(deviceData),
                backgroundColor: Object.keys(deviceData).map(key => deviceColors[key] || '#858796'),
            }]
        };

        new Chart(document.getElementById('deviceChart'), {
            type: 'doughnut',
            data: deviceChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Hourly Chart
        new Chart(document.getElementById('hourlyChart'), {
            type: 'bar',
            data: {
                labels: Object.keys({!! json_encode($analytics['hourly_breakdown']) !!}),
                datasets: [{
                    label: '{{ __('analytics.total') }}',
                    data: Object.values({!! json_encode($analytics['hourly_breakdown']) !!}).map(v => v.total),
                    backgroundColor: '#4e73df',
                    borderRadius: 4
                }, {
                    label: '{{ __('analytics.unique') }}',
                    data: Object.values({!! json_encode($analytics['hourly_breakdown']) !!}).map(v => v.unique),
                    backgroundColor: '#1cc88a',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

    } catch (error) {
        console.error('Error initializing charts:', error);
    }
});
</script>
@endpush
@endsection
