@extends('layouts.app')

@section('content')
    <!--  container fluid start here -->
    <div class="profile-management-page container-fluid mt-0">

        <h2 class="mt-5 mt-lg-0 offset-0 offset-lg-1 ps-0 ps-lg-3 fw-bold"
            style="color: #0A0B2F;font-size:2.25rem;font-weight:600 !important;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ __('dashboard.welcome') }} {{ auth()->user()->name }}</h2>

        <!-- Button sections start here -->
        <div class="div d-lg-flex gap-4 w-75  offset-0  offset-lg-1   mt-5 links-section">

            <div class="div profile-management-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center profile-management-btn py-3   shadow " aria-current="page"
                    href="{{ route('profileManagement') }}" style="background-color: #090835; color: #FFFFFF;">
                    <img src="{{ asset('storage/profilemanagement/Person.svg') }}" style="height: 1.5rem">


                    {{ __('dashboard.profile_management') }}
                </a>
            </div>


            <div class="div my-broadcasts-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center py-3   my-broadcasts-btn my-broadcasts-btn my-broadcasts-btn-height shadow "
                    aria-current="page" href="{{ route('myBroadcasts') }}" style="border: 2px solid #090835; color: #090835;">
                    <span class="">
                        <img src="{{ asset('storage/profilemanagement/Stream.svg') }}" style="height: 1.5rem;">

                         {{ __('dashboard.my_broadcasts') }}
                    </span>
                </a>
            </div>


            <div class="div comment-management-btn-div mt-3">
                <a class="nav-link active rounded-pill py-3  text-center comment-management-btn shadow " aria-current="page"
                    href="{{ route('commentManagement') }}">
                    <img src="{{ asset('storage/profilemanagement/Comment.svg') }}" style="height: 1.5rem">

                    {{ __('dashboard.comment_management') }}
                </a>
            </div>


            <div class="div subscription-btn-div mt-3">
                <a class="nav-link active rounded-pill text-center subscription-management-btn py-3   shadow "
                    aria-current="page" href="{{ route('currentSubscription') }}">
                    <img src="{{ asset('storage/profilemanagement/Subscription.svg') }}" style="height: 1.5rem">

                    {{ __('dashboard.subscription_management') }}
                </a>

            </div>
        </div>
        <!-- Button sections end here -->


        <!--  container start here -->
        <div class="container  mt-5 pb-0 px-0">
            <h2 class="mt-4 mt-lg-4 ms-lg-5 ms-md-2 " style="color: #0A0B2F;font-size:2rem;font-weight:600 !important;">
                Channel Name:</h2>


            <!-- Card start here -->
            <div class="card mb-3 ms-lg-5 ms-0  mb-5 px-3 px-lg-5 py-4 pb-4 shadow border-0 mt-4 information-card">

                <!-- Form start here-->
                
                    <!-- Main row start here -->
                    <div class="row g-lg-5 g-md-5 g-2">

                        <!-- Edit btn for mobile scree -->
                        <div class="col-12 d-none col-md-12 text-end  ">
                        <a href="#" class="btn rounded-pill  px-3  mt-3 text-light"
   style="background-color:#090835 ; font-size: 11px;" 
   onclick="userButtonClick()">
   {{ __('dashboard.edit_info') }} <i class="fa-solid fa-pen"></i>
</a>
                        </div>

<style>
    
    .profile-pic{
       width: 10rem;
    height: 10rem;
    object-fit: cover;
    border: 1px solid #090835;
    border-radius: 82px;
    }
    [type="file"] {

  color: #878787;
}
[type="file"]::-webkit-file-upload-button {
  background: #090835;
  border: 2px solid #090835;
  border-radius: 4px;
  color: #fff;
  cursor: pointer;
  font-size: 12px;
  outline: none;
  padding: 10px 25px;
  text-transform: uppercase;
  transition: all 1s ease;
}

[type="file"]::-webkit-file-upload-button:hover {
  background: #fff;
  border: 2px solid #090835;
  color: #000;
}
@media (min-width: 1024px) and (max-width: 1199px) {
    .same-top-links-buttons .profile-management-btn-div {
    width: 100% !important;
}
.same-top-links-buttons .my-broadcasts-btn-div {
    width: 100% !important;
}
.same-top-links-buttons .comment-management-btn-div {
    width: 100% !important;
}    
.same-top-links-buttons .subscription-btn-div {
    width: 100% !important;
}
.same-top-links-buttons .links-section{
    flex-wrap:wrap !important;
    padding:0 !important;
    gap:0 !important;
    
}

}
</style>

                        <div class="col-12 col-lg-3 col-md-12">

                <img src="{{ auth()->user()->profile_picture_path ? asset('storage/' . auth()->user()->profile_picture_path) : asset('storage/profile_picture/placeholder-image.jpg') }}" 
     id="output" 
     class="img-fluid mx-auto mx-lg-0 d-flex mt-2 profile-pic mb-3" 
     alt="Profile Picture">
                            <h5 class="card-title mt-4 text-center text-lg-start mb-3" style="color: #0A0B2F;margin-left:0.6rem">
                                {{auth()->user()->name}}
                            </h5>
                            
                          @php
    // Get the user's subscription
    $subscription = auth()->user()->subscriptions()->first();

    
    $planName = null;
    $expiryDate = null;

    if ($subscription) {
        $rawPlanName = $subscription->paypalPlan->name ?? null;


        if ($rawPlanName === 'Basic') {
            $planName = 'Basic';
        } elseif ($rawPlanName === 'Standard') {
            $planName = 'Smart';
        } elseif ($rawPlanName === 'Premium') {
            $planName = 'Gold';
        }
        $expiryDate = $subscription->expire_date;
    }
@endphp
                            
                                @if ($subscription)
        <p class="text-center text-lg-start" style="margin-left: 0.6rem;">
            Your plan is <strong>{{ $planName }}</strong> and expires on <strong>{{ \Carbon\Carbon::parse($expiryDate)->format('F j, Y') }}</strong>.
        </p>
    @else
        <p class="text-center text-lg-start" style="margin-left: 0.6rem;">
            You currently have no active subscription.
        </p>
    @endif

                            

                        </div>
                        <div class="col-12 col-lg-9 col-md-12">
                                    <form action="{{ route('profile.update.user', ['id' => auth()->user()->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
                        <div class="col-12 col-lg-12 col-md-12">

                            <div class="card-body px-0 ps-md-3 pt-0">
   <h5 class="card-title" style="font-size:1.5rem;font-weight:600">{{ __('dashboard.personal_information') }}</h5>

                                <!-- Nested Row start-->
                                <div class="row mt-3 mt-lg-3">

                           <div class="col-12 col-lg-6">
                    <label for="name" class="">{{ __('dashboard.name') }}</label>
                    <input type="text" name="name" class="form-control mt-2 @error('name') is-invalid @enderror"
                        placeholder="Alex Martyr" value="{{ old('name', auth()->user()->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

              <div class="col-12 col-lg-6">
                    <label for="email" class="">{{ __('dashboard.email_address') }}</label>
                    <input type="text" name="email" readonly class="form-control mt-2 @error('email') is-invalid @enderror"
                        placeholder="Alex.Martyr@gmail.com" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                                  

                                    <div class="col-12 col-lg-6">
                                          <label for="" class="mt-4">{{ __('dashboard.profile_picture') }}</label>
                                         <input style="border:0 !important" type="file" accept="image/*" class="file-input @error('profile_picture') is-invalid @enderror" onchange="loadFile(event)" name="profile_picture">
                    @error('profile_picture')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

<script>
    var loadFile = function (event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
};

</script>
                                    </div>




                                    <!-- Hide fileds start here -->
                   <div class="row mt-5 m-0 p-0" id="hideFields">
                    <h3 style="color: #0A0B2F;font-size:1.25rem;font-weight:600;">{{ __('dashboard.change_password') }}</h3>

                    <div class="col-12 col-lg-6">
                        <label for="current_password" class="mt-3">{{ __('dashboard.current_password') }}</label>
                        <input id="current_password" type="password" name="current_password" class="form-control mt-2 @error('current_password') is-invalid @enderror" placeholder="*** ***** ****">
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="new_password" class="mt-3">{{ __('dashboard.new_password') }}</label>
                        <input id="new_password" type="password" name="new_password" class="form-control mt-2 @error('new_password') is-invalid @enderror" placeholder="*** ***** ****">
                        @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-6">
                        <label for="new_password" class="mt-3">{{ __('dashboard.confirm_password') }}</label>
                        <input id="new_password" type="password" name="c_password" class="form-control mt-2 @error('c_password') is-invalid @enderror" placeholder="*** ***** ****">
                        @error('c_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                
                <!---------------AREA DE PIXEL COMEÇA AQUI----------------------------------->
<div class="row mt-5 m-0 p-0" id="trackingFields">
    <h3 style="color: #0A0B2F;font-size:1.25rem;font-weight:600;">Tracking Pixels</h3>

    <div class="col-12 col-lg-6">
        <label for="facebook_pixel" class="mt-3">Facebook Pixel</label>
        <textarea id="facebook_pixel" name="facebook_pixel" class="form-control mt-2" placeholder="Enter Facebook Pixel">{{ old('facebook_pixel', auth()->user()->facebook_pixel) }}</textarea>
    </div>

    <div class="col-12 col-lg-6">
        <label for="google_ads_pixel" class="mt-3">Google Ads Pixel</label>
        <textarea id="google_ads_pixel" name="google_ads_pixel" class="form-control mt-2" placeholder="Enter Google Ads Pixel">{{ old('google_ads_pixel', auth()->user()->google_ads_pixel) }}</textarea>
    </div>

    <div class="col-12 col-lg-6">
        <label for="tiktok_pixel" class="mt-3">TikTok Pixel</label>
        <textarea id="tiktok_pixel" name="tiktok_pixel" class="form-control mt-2" placeholder="Enter TikTok Pixel">{{ old('tiktok_pixel', auth()->user()->tiktok_pixel) }}</textarea>
    </div>
</div>

<!---------------AREA DE PIXEL TERMINA AQUI----------------------------------->

                                    <!-- Hide fileds end here -->



                                </div>
                                <!-- Nested Row end-->

                            </div>
                        </div>
                        </div>
                        <!-- Edit btn for dekstop screen -->

                      
<div class="row text-center">
                      <div class="col-12 col-lg-8 mx-auto">
            <button type="submit" class="btn text-white mt-4 w-auto mx-auto" style="border-radius: 8px; background-color: #090835; font-weight:600;">{{ __('dashboard.save_changes') }}</button>
        </div>
                </div>

                    </div>
                    <!-- Main row end here -->



                </form>
                        </div>

                <!-- Form end here-->
            </div>
            <!-- Card end here -->


        </div>
        <!--  container end here -->

    </div>
    <!--  container fluid end here -->


    <!-- My custom js here -->
 {{-- Script for show and hide password --}}
 <script>
    var pass = document.getElementById("password");
    var eyeIcon = document.getElementById("eye_icon");
    eyeIcon.addEventListener("click", function() {
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

    // For current Password
    var currentPassword = document.getElementById("current_password");
    var eyeIconcurrentPassword = document.getElementById("eye_icon_current_password");
    eyeIconcurrentPassword.addEventListener("click", function() {
        if (currentPassword.type === 'password') {
            currentPassword.type = 'text';
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        } else {
            currentPassword.type = 'password';
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        }
    });

    // For New Password
    var newPassword = document.getElementById("new_password");
    var eyeIconNewPassword = document.getElementById("eye_icon_new_password");
    eyeIconNewPassword.addEventListener("click", function() {
        if (newPassword.type === 'password') {
            newPassword.type = 'text';
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        } else {
            newPassword.type = 'password';
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        }
    });

    // For New Password
    var confirmPassword = document.getElementById("confirm_password");
    var eyeIconConfirmPassword = document.getElementById("eye_icon_confirm_password");
    eyeIconConfirmPassword.addEventListener("click", function() {
        if (confirmPassword.type === 'password') {
            confirmPassword.type = 'text';
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        } else {
            confirmPassword.type = 'password';
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        }
    });
</script>


    <script>
        function userButtonClick() {
            let hideFields = document.getElementById("hideFields");
            hideFields.classList.remove("d-none");
        }
    </script>


@endsection
