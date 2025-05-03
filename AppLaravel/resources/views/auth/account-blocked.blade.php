@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">{{ __('dashboard.account_blocked_title') }}</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-lock fa-4x text-danger mb-3"></i>
                        <h5 class="font-weight-bold">{{ __('dashboard.account_blocked_heading') }}</h5>
                    </div>

                    <div class="alert alert-warning">
                        <p class="mb-0">
                            {{ __('dashboard.account_blocked_message') }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <p>{{ __('dashboard.account_blocked_support') }}</p>
                        <ul>
                            <li>{{ __('dashboard.account_blocked_email') }}: <a href="mailto:support@liveturb.com">support@liveturb.com</a></li>
                        </ul>
                    </div>

                    <div class="text-center mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('dashboard.account_blocked_logout_button') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
