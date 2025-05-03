@extends('layouts.guest')

@section('content')
    {{-- Bootstrapo cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <section class="login-section ">
        @include('navbar')

        <!-- Main row start here -->
        <div class="row p-0 m-0 min-vh-100">

            <div class="col-12 mt-1 col-lg-6  order-lg-first order-last login-form h-100 pt-lg-1 pt-0 mb-4">
                <!-- Form section start here -->
                <div class="form-section mx-auto">
                    <a href="https://app.liveturb.com">
                        <img src="{{ asset('storage/sitelogo/logo_light.png') }}" alt="" height="" class=""
                            style="height:7rem;width:19rem;margin-left:-5rem;">
                    </a>
                    <h5 class="fs-1 mt-3">{{ __('home.register') }}</h5>

                    <form action="{{ route('user.store', $plan->uuid) }}" method="POST" id="registerForm">
                        @csrf

                        {{-- Campo para Nome --}}
                        <label for="" class="form-label mt-3 mb-0">{{ __('home.name_label') }}</label>
                        <div class="d-flex">
                            <i class="fa-solid fa-user mt-2 pt-1 fs-6 border-0 border-bottom border-3"></i>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control mt-0 border-0 border-bottom border-3 shadow-none"
                                placeholder="{{ __('home.name_placeholder') }}">
                        </div>
                        @error('name')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- Campo para WhatsApp --}}
                        <label for="" class="form-label mt-5 mb-0">{{ __('home.whatsapp_label') }}</label>
                        <div class="d-flex">
                            <i class="fa-solid fa-user mt-2 pt-1 fs-6 border-0 border-bottom border-3"></i>
                            <input type="text" name="whatsapp_no" value="{{ old('whatsapp_no') }}"
                                class="form-control mt-0 border-0 border-bottom border-3 shadow-none whatsnum-input"
                                placeholder="{{ __('home.whatsapp_placeholder') }}">
                        </div>
                        @error('whatsapp_no')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- Campo para Email --}}
                        <label for="" class="form-label mt-5 mb-0">{{ __('home.email_label') }}</label>
                        <div class="d-flex">
                            <i class="fa-solid fa-envelope mt-2 pt-1 fs-6 border-0 border-bottom border-3"></i>
                            <input type="text" name="email" value="{{ old('email') }}"
                                class="form-control mt-0 border-0 border-bottom border-3 shadow-none"
                                placeholder="{{ __('home.email_placeholder') }}">
                        </div>
                        @error('email')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- Campo para Senha --}}
                        <label for="" class="mt-5 mb-0 form-label">{{ __('home.password_label') }}</label>
                        <div class="d-flex">
                            <i class="fa-solid fa-lock mt-2 pt-1 fs-6 border-0 border-bottom border-3"></i>
                            <input type="password" name="password" id="password"
                                class="form-control mt-0 border-0 border-bottom border-3 shadow-none"
                                placeholder="{{ __('home.password_placeholder') }}">
                            <i id="clickEyeidcon"
                                class="fa-solid fa-eye-slash mt-3 pt-0 text-end border-0 border-bottom border-3"
                                style="font-size: 13px;"></i>
                        </div>
                        @error('password')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- Campo para Confirmação de Senha --}}
                        <label for="" class="mt-5 mb-0 form-label">{{ __('home.confirm_password_label') }}</label>
                        <div class="d-flex">
                            <i class="fa-solid fa-lock mt-2 pt-1 fs-6 border-0 border-bottom border-3"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control mt-0 border-0 border-bottom border-3 shadow-none"
                                placeholder="{{ __('home.confirm_password_placeholder') }}">
                            <i id="clickEyeidconConfirmPass"
                                class="fa-solid fa-eye-slash mt-3 pt-0 text-end border-0 border-bottom border-3"
                                style="font-size: 13px;"></i>
                        </div>
                        @error('password_confirmation')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- Campo Oculto para Método de Pagamento (pré-definido como Stripe) --}}
                        <input type="hidden" name="payment_method" value="stripe">
                        
                        {{-- Campo oculto para o token do reCAPTCHA v3 --}}
                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response-register">
                        
                        @error('recaptcha')
                            <div class="text-center">
                                <span style="color: red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        @enderror

                        {{-- Botão de Registro --}}
                        <div class="mx-auto mb-lg-0 mb-4 btn-div" style="width: 28%;">
                            <button type="submit" class="btn btn fs-3 text-light shadow-lg mt-4 form-control register-btn">
                                {{ __('home.register_button') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-lg-6 text-center justify-content-center align-items-center order-lg-last order-start bg-left-color"
                style="background-color: #0A0B2F;">
                <div class="form-text mt-5 pt-5">
                    <h1 class="" style="font-size:3rem; color:#FFFFFF;">A PLATAFORMA QUE </h1>
                    <h1><span style="font-size:3rem;color:#FFFFFF;"> VAI </span> <span
                            style="color: #07D9DE;;font-size:3rem"> MUDAR</span> <span
                            style="font-size:3rem;color:#FFFFFF;font-family:'Bauhaus 93', sans-serif;"> SEU </span> <span
                            style="color: #07D9DE;font-size:3rem">GAME !!</span></h1>
                    <img src="{{ asset('storage/login/login-small-image.png') }}"
                        class="img-fluid d-flex mx-auto login-big-image mt-3 ps-1">
                </div>
            </div>
        </div>
    </section>

    <script>
        // Executa o reCAPTCHA v3 quando a página carrega
        document.addEventListener('DOMContentLoaded', function() {
            executeRecaptcha('register', 'register');
        });
        
        // Executa o reCAPTCHA v3 antes do envio do formulário
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            executeRecaptcha('register', 'register');
            
            // Facebook Pixel - CompleteRegistration event
            if (typeof fbq !== 'undefined') {
                fbq('track', 'CompleteRegistration', {
                    content_name: 'registro-usuario',
                    status: true
                });
            }
            
            setTimeout(() => {
                this.submit();
            }, 1000);
        });
    </script>
@endsection
