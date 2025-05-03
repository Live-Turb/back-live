@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ __('dashboard.edit_user') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('dashboard.user_info') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('dashboard.name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('dashboard.email') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="plan_id" class="form-label">{{ __('dashboard.select_plan') }}</label>
                        <select class="form-select @error('plan_id') is-invalid @enderror" id="plan_id" name="plan_id">
                            <option value="">{{ __('dashboard.no_plan_user') }}</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ (old('plan_id', $userPlan)) == $plan->id ? 'selected' : '' }}>
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
                        <input type="date" class="form-control @error('expiration_date') is-invalid @enderror" id="expiration_date" name="expiration_date" value="{{ old('expiration_date', $expirationDate) }}">
                        @error('expiration_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">{{ __('dashboard.user_status') }}</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>{{ __('dashboard.user_active') }}</option>
                            <option value="blocked" {{ old('status', $user->status) == 'blocked' ? 'selected' : '' }}>{{ __('dashboard.user_inactive') }}</option>
                            <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>{{ __('dashboard.user_pending') }}</option>
                            <option value="expired" {{ old('status', $user->status) == 'expired' ? 'selected' : '' }}>{{ __('dashboard.user_expired') }}</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">{{ __('dashboard.cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('dashboard.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('dashboard.password_management') }}</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6>{{ __('dashboard.current_password_hash') }}</h6>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ __('dashboard.password_hash_info') }}" id="passwordHash" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="copyPassword">{{ __('dashboard.copy_password') }}</button>
                    </div>
                    <small class="form-text text-muted mt-2">{{ __('dashboard.password_cannot_be_recovered') }}</small>
                </div>
                
                <hr>
                
                <h6>{{ __('dashboard.set_new_password') }}</h6>
                <form action="{{ route('admin.users.update.password', $user->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">{{ __('dashboard.new_password') }}</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                        @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-warning">{{ __('dashboard.update_password') }}</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('copyPassword').addEventListener('click', function() {
            var passwordHash = document.getElementById('passwordHash');
            passwordHash.select();
            document.execCommand('copy');
            
            // Alerta de confirmação
            alert('{{ __("dashboard.password_copied") }}');
        });
    </script>
@endsection
