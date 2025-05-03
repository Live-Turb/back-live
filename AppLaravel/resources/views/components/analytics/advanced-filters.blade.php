<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h6 class="card-title text-muted mb-3">{{ __('analytics.filters') }}</h6>
        <form action="{{ route('analytics.dashboard') }}" method="GET" class="row g-3">
            <!-- Period Filter -->
            <div class="col-md-3">
                <label class="form-label">{{ __('analytics.period') }}</label>
                <select name="period" class="form-select" id="period-select">
                    <option value="7" {{ request('period') == '7' ? 'selected' : '' }}>
                        {{ __('analytics.last_7_days') }}
                    </option>
                    <option value="30" {{ request('period', '30') == '30' ? 'selected' : '' }}>
                        {{ __('analytics.last_30_days') }}
                    </option>
                    <option value="90" {{ request('period') == '90' ? 'selected' : '' }}>
                        {{ __('analytics.last_90_days') }}
                    </option>
                    <option value="custom" {{ request('period') == 'custom' ? 'selected' : '' }}>
                        {{ __('analytics.custom_range') }}
                    </option>
                </select>
            </div>

            <!-- Date Range -->
            <div class="col-md-3 date-range" style="{{ request('period') == 'custom' ? '' : 'display: none;' }}">
                <label class="form-label">{{ __('analytics.start_date') }}</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3 date-range" style="{{ request('period') == 'custom' ? '' : 'display: none;' }}">
                <label class="form-label">{{ __('analytics.end_date') }}</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>

            <!-- Video Filter -->
            <div class="col-md-3">
                <label class="form-label">{{ __('analytics.select_video') }}</label>
                <select name="video_id" class="form-select">
                    <option value="">{{ __('analytics.all_videos') }}</option>
                    @foreach($videos as $video)
                        <option value="{{ $video->id }}" {{ request('video_id') == $video->id ? 'selected' : '' }}>
                            {{ $video->details_video_title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Buttons -->
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    {{ __('analytics.apply_filters') }}
                </button>
                <a href="{{ route('analytics.dashboard') }}" class="btn btn-outline-secondary">
                    {{ __('analytics.reset_filters') }}
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializa o collapse
    var advancedFilters = document.getElementById('advancedFilters');
    var collapse = new bootstrap.Collapse(advancedFilters, {
        toggle: false
    });
});
</script>
@endpush
