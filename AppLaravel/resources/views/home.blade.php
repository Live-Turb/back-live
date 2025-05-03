@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Dashboard') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">
                <p>
                    {{ __('You are logged in!') }}
                </p>
            </div>
        </div>
    </div>
     <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Redirect immediately to the my-broadcasts route
            window.location.href = "{{ route('myBroadcasts') }}";
        });
    </script>
@endsection
