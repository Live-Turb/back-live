@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('My profile') }}</h2>
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

                @if ($message = Session::get('success'))
                    <div class="alert-box success-alert">
                        <div class="alert">
                            <h4 class="alert-heading">Success</h4>
                            <p class="text-medium">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" @error('name') class="form-control is-invalid" @enderror name="name"
                                       id="name" placeholder="{{ __('Name') }}"
                                       value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="email">{{ __('Email') }}</label>
                                <input @error('email') class="form-control is-invalid" @enderror type="email"
                                       name="email" id="email" placeholder="{{ __('Email') }}"
                                       value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password">{{ __('New password') }}</label>
                                <input type="password" @error('password') class="form-control is-invalid"
                                       @enderror name="password" id="password" placeholder="{{ __('New password') }}"
                                       required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password_confirmation">{{ __('New password confirmation') }}</label>
                                <input type="password" @error('password') class="form-control is-invalid"
                                       @enderror name="password_confirmation" id="password_confirmation"
                                       placeholder="{{ __('New password confirmation') }}" required>
                            </div>
                        </div>
                        <!-- end col -->

                        <!-- Tracking Pixels Section -->
                        <div class="col-12">
                            <h3 style="color: #0A0B2F; font-size: 1.25rem; font-weight: 600;">{{ __('Tracking Pixels') }}</h3>
                        </div>

                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="facebook_pixel">{{ __('Facebook Pixel') }}</label>
                                <textarea name="facebook_pixel" id="facebook_pixel" class="form-control"
                                          placeholder="{{ __('Enter Facebook Pixel') }}">{{ old('facebook_pixel', auth()->user()->facebook_pixel) }}</textarea>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="google_ads_pixel">{{ __('Google Ads Pixel') }}</label>
                                <textarea name="google_ads_pixel" id="google_ads_pixel" class="form-control"
                                          placeholder="{{ __('Enter Google Ads Pixel') }}">{{ old('google_ads_pixel', auth()->user()->google_ads_pixel) }}</textarea>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="tiktok_pixel">{{ __('TikTok Pixel') }}</label>
                                <textarea name="tiktok_pixel" id="tiktok_pixel" class="form-control"
                                          placeholder="{{ __('Enter TikTok Pixel') }}">{{ old('tiktok_pixel', auth()->user()->tiktok_pixel) }}</textarea>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
