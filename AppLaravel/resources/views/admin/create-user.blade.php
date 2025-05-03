@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ __('dashboard.create_user') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('dashboard.user_info') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('dashboard.name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('dashboard.email') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('dashboard.new_password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('dashboard.plan_details') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="plan_id" class="form-label">{{ __('dashboard.select_plan') }}</label>
                        <select class="form-select @error('plan_id') is-invalid @enderror" id="plan_id" name="plan_id">
                            <option value="">{{ __('dashboard.no_plan_user') }}</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} - ${{ number_format($plan->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="expiration_date" class="form-label">{{ __('dashboard.expiration_date') }}</label>
                        <input type="date" class="form-control @error('expiration_date') is-invalid @enderror" id="expiration_date" name="expiration_date" value="{{ old('expiration_date') }}">
                        @error('expiration_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">{{ __('dashboard.user_status') }}</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ __('dashboard.user_active') }}</option>
                            <option value="blocked" {{ old('status') == 'blocked' ? 'selected' : '' }}>{{ __('dashboard.user_inactive') }}</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>{{ __('dashboard.user_pending') }}</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">{{ __('dashboard.cancel') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('dashboard.create_user') }}</button>
            </div>
        </form>
    </div>
@endsection
