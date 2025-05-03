@extends('layouts.guest')

@section('content')
    {{-- CSS Resources --}}
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('css/login.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    {{-- JavaScript Resources --}}
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<style>
        .login-btn{
                                transition:all 0.3s ease-in-out;
                                border:1px solid #155de3;
                            }
                            .login-btn:hover{
                                background-color:#FFFFFF !important;
                                color:#155de3 !important;
                            }
</style>
    <section class="login-section ">

        @include('navbar')
        <!-- Main row start here -->
        <div class="row p-0 m-0 min-vh-100">

            <div class="col-12 mt-5 col-lg-6  order-lg-first order-last login-form h-100 pt-lg-0 pt-0">


                <!-- Form section start here -->
                <div class="form-section mx-auto">
   <a href="https://app.liveturb.com">
                      <img src="{{ asset('storage/sitelogo/logo_light.png') }}" alt="" height="" class=""
                    style="height:7rem;width:19rem;margin-left:-5rem;">
                </a>
                    <h5 class="fs-1 mt-3 ">{{ __('home.login') }}</h5>
                    <!--<strong class="mt-3 d-block" style="font-weight:700;color:#000000">If you don’t have an account-->
                    <!--    register,</strong>-->
                    <!--<p class="fs-6 mt-3"> <span class="fs-6 me-2">You can</span> <a href="{{route('register')}}"-->
                    <!--        class="text-decoration-none fs-6" style="font-weight: 700">Register here!</a></p>-->

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                      <label for="" class="form-label mt-3">{{ __('home.email_label') }}</label>
    <div class="d-flex">
        <i class="fa-solid fa-envelope mt-2 pt-1 fs-6 border-0 border-bottom border-3"></i>
<input name="email" type="email" value="{{ old('email') }}"
            class="form-control mt-0 border-0 border-bottom border-3 shadow-none"
            placeholder="{{ __('home.email_placeholder') }}"
            autocomplete="username">
    </div>
                        <div class="d-flex">
                            @error('email')
                                <span style="color: red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="" class="mt-5 form-label">Password</label>
                       <div class="d-flex">
        <i class="fa-solid fa-lock mt-2 pt-1 fs-6 border-0 border-bottom border-3"></i>
<input type="password" name="password" id="password"
            class="form-control mt-0 border-0 border-bottom border-3 shadow-none"
            placeholder="{{ __('home.password_placeholder') }}"
            autocomplete="current-password">
        <i style="cursor:pointer;" id="clickEyeidcon"
            class="fa-solid fa-eye-slash mt-3 pt-0 text-end border-0 border-bottom border-3"
            style="font-size: 13px;"></i>
    </div>
                        <div class="d-flex">
                            @error('password')
                                <span style="color: red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Nested row  start-->
                          <div class="row mt-3">
        <div class="col-6 ps-3">
            <input type="checkbox" name="remember" id="remember" class="mt-2">
            <label class="remember" for="remember">{{ __('home.remember_me') }}</label>
        </div>
    </div>

<p class="text-center mt-4">
    <a href="{{ route('password.request') }}" class="text-decoration-none">
        {{ __('Esqueceu sua senha?') }}
    </a>
</p>
                </div>

                <!-- Nested row end -->


                 <div class="mx-auto mb-lg-0 mb-4 btn-div" style="width: 58%;">
        <button type="submit" class="btn btn fs-3 text-light shadow-lg mt-5 form-control login-btn">
            {{ __('home.login_button') }}
        </button>
    </div>

                </form>
            </div>
            <!-- Form section end here -->




            <!-- form image start here  -->
            <div class="col-12 col-lg-6 text-center justify-content-center align-items-center order-lg-last order-start bg-left-color "
                style=" background-color: #0A0B2F;">

                <div class="form-text mt-5 pt-5" style="font-family:'Bauhaus 93', sans-serif;">
                    <h1 class="" style="font-size:3rem; color:#FFFFFF;">A PLATAFORMA QUE </h1>
                    <h1><span style="font-size:3rem;color:#FFFFFF;"> VAI </span> <span
                            style="color: #07D9DE;;font-size:3rem"> MUDAR</span> <span
                            style="font-size:3rem;color:#FFFFFF;font-family:'Bauhaus 93', sans-serif;"> SEU </span> <span
                            style="color: #07D9DE;font-size:3rem">GAME !!</span></h1>

                    <img src="{{ asset('storage/login/login-small-image.png') }}"
                        class="img-fluid d-flex mx-auto login-big-image mt-3 ps-1">
                </div>


            </div>
            <!-- form image end  -->


        </div>
        <!-- Main row end here -->


        {{-- Script for tostr popou --}}
        <script>
            @if (Session::has('success'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ session('success') }}");
                // toastr.success("{{ session('success') }}" ,'Success!',{timeOut:12000});
            @endif
        </script>

        <script>
            @if (Session::has('error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.warning("{{ session('error') }}");
                // toastr.warning("{{ session('error') }}" ,'Success!',{timeOut:12000});
            @endif
        </script>


        {{-- Script for show and hide password --}}
        <script>
            var pass = document.getElementById("password");
            var eyeicon = document.getElementById("clickEyeidcon");
            eyeicon.addEventListener("click", function() {
                if (pass.type === 'password') {
                    pass.type = 'text';
                    this.classList.remove("fa-eye");
                    this.classList.add("fa-eye-slash");
                } else {
                    pass.type = 'password';
                    this.classList.remove("fa-eye-slash");
                    this.classList.add("fa-eye");
                }
            });
        </script>


    </section>


    {{-- <div class="col-lg-6">
        <div class="auth-cover-wrapper bg-primary-100">
            <div class="auth-cover">
                <div class="title text-center">
                    <h1 class="text-primary mb-10">{{ __('Login') }}</h1>
                </div>
                <div class="cover-image">
                    <img src="{{ asset('images/auth/signin-image.svg') }}" alt="">
                </div>
                <div class="shape-image">
                    <img src="{{ asset('images/auth/shape.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="signin-wrapper">
            <div class="form-wrapper">
                <h6 class="mb-15">{{ __('Login') }}</h6>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="email">{{ __('Email') }}</label>
                                <input @error('email') class="form-control is-invalid" @enderror type="email" name="email" id="email" placeholder="{{ __('Email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" @error('password') class="form-control is-invalid" @enderror name="password" id="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-12 col-md-6">
                            <div class="form-check checkbox-style mb-30">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" value="" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}</label>
                            </div>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div> --}}
@endsection
