@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/my-broadcasts.css') }}" />
    <style>
        .current-subscription-page .box-header .box-title2 {
      color: var(--light-color) ;
    font-size: 1.3rem !important;
    font-weight: 600 !important;
}

label.radio-card-modal {
  cursor: pointer;
  margin: .5em;
}
label.radio-card-modal .card-content-wrapper {
  background: #fff;
  border-radius: 5px;
  padding: 15px;
  box-shadow: 0 2px 4px 0 rgba(219, 215, 215, 0.04);
  transition: 200ms linear;
  position: relative;
	 min-width: 170px;
}
label.radio-card-modal .check-icon {
  width: 20px;
  height: 20px;
  display: inline-block;
  border-radius: 50%;
  transition: 200ms linear;
  position: absolute;
  right: -10px;
  top: -10px;
}
label.radio-card-modal .check-icon:before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg width='12' height='9' viewBox='0 0 12 9' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0.93552 4.58423C0.890286 4.53718 0.854262 4.48209 0.829309 4.42179C0.779553 4.28741 0.779553 4.13965 0.829309 4.00527C0.853759 3.94471 0.889842 3.88952 0.93552 3.84283L1.68941 3.12018C1.73378 3.06821 1.7893 3.02692 1.85185 2.99939C1.91206 2.97215 1.97736 2.95796 2.04345 2.95774C2.11507 2.95635 2.18613 2.97056 2.2517 2.99939C2.31652 3.02822 2.3752 3.06922 2.42456 3.12018L4.69872 5.39851L9.58026 0.516971C9.62828 0.466328 9.68554 0.42533 9.74895 0.396182C9.81468 0.367844 9.88563 0.353653 9.95721 0.354531C10.0244 0.354903 10.0907 0.369582 10.1517 0.397592C10.2128 0.425602 10.2672 0.466298 10.3112 0.516971L11.0651 1.25003C11.1108 1.29672 11.1469 1.35191 11.1713 1.41247C11.2211 1.54686 11.2211 1.69461 11.1713 1.82899C11.1464 1.88929 11.1104 1.94439 11.0651 1.99143L5.06525 7.96007C5.02054 8.0122 4.96514 8.0541 4.90281 8.08294C4.76944 8.13802 4.61967 8.13802 4.4863 8.08294C4.42397 8.0541 4.36857 8.0122 4.32386 7.96007L0.93552 4.58423Z' fill='white'/%3E%3C/svg%3E%0A");
  background-repeat: no-repeat;
  background-size: 12px;
  background-position: center center;
  transform: scale(1.6);
  transition: 200ms linear;
  opacity: 0;
}
label.radio-card-modal input[type=radio] {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}
label.radio-card-modal input[type=radio]:checked + .card-content-wrapper {
  box-shadow: 0 2px 4px 0 rgba(219, 215, 215, 0.5), 0 0 0 2px #3057d5;
}
label.radio-card-modal input[type=radio]:checked + .card-content-wrapper .check-icon {
  background: #3057d5;
  border-color: #3057d5;
  transform: scale(1.2);
}
label.radio-card-modal input[type=radio]:checked + .card-content-wrapper .check-icon:before {
  transform: scale(1);
  opacity: 1;
}
label.radio-card-modal input[type=radio]:focus + .card-content-wrapper .check-icon {
  box-shadow: 0 0 0 4px rgba(48, 86, 213, 0.2);
  border-color: #3056d5;
}
label.radio-card-modal .card-content img {
  margin-bottom: 10px;
}
label.radio-card-modal .card-content h4 {
  font-size: 16px;
  letter-spacing: -0.24px;
  text-align: center;
  color: #1f2949;
		margin: 0;
}
label.radio-card-modal .card-content h5 {
  font-size: 14px;
  line-height: 1.4;
  text-align: center;
  color: #686d73;
}
.card-body.boxes{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
 .package-card{
         height:29rem;
     }
@media screen and (max-width: 767px) {
   .row.box-header{
       align-items:center;
   }
     .payment-container{
         flex-wrap:wrap;
     }
}
@media (min-width: 576px) {
    .modal-dialog {
        max-width: 600px;
    }
}
     @media (min-width: 768px) and (max-width: 1023px) {
     .package-card{
         height:30rem;
     }
      .row.box-header{
       align-items:center;
   }
      .current-subscription-page .box-header .dollar {
    font-size: 14px !important;

}
.current-subscription-page .box-header .num {
    font-size: 14px !important;
}
.current-subscription-page .box-header .box-title2{
    font-size:1rem !important;
}
}
    @media (min-width: 1024px) and (max-width: 1199px) {
     .package-card{
         height:32rem;
     }
      .row.box-header{
       align-items:center;
   }
   .current-subscription-page .box-header .dollar {
    font-size: 14px !important;

}
.current-subscription-page .box-header .num {
    font-size: 14px !important;
}
.current-subscription-page .box-header .box-title2{
    font-size:1rem !important;
}
}

    </style>
    <!--  container fluid start here -->
    <div class="current-subscription-page same-top-links-buttons second-page mt-0">


        <div class="container">
               <h2 class="mt-5 mt-lg-0 d-none" style="color: #0A0B2F;">{{ __('dashboard.welcome') }} {{ auth()->user()->name }}</h2>

        </div>

        <!-- Button sections start here -->
        <div class="div   d-lg-flex gap-4 offset-1 ps-2 pe-2 mt-4 mt-lg-0 links-section ">

            <div class="div profile-management-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center profile-management-btn py-3   shadow " aria-current="page"
                    href="{{route('profileManagement')}}"> <img src="{{ asset('storage/currentsubscription/Person.svg') }}" style="height: 1.5rem">

                   {{ __('dashboard.profile_management') }}
                </a>
            </div>


            <div class="div my-broadcasts-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center py-3   my-broadcasts-btn my-broadcasts-btn-height shadow "
                    aria-current="page" href="{{route('myBroadcasts')}}">
                    <span class="my-broadcasts-btn-text">
                        <img src="{{ asset('storage/currentsubscription/Stream.svg') }}">
                       {{ __('dashboard.my_broadcasts') }}
                    </span>
                </a>
            </div>


            <div class="div comment-management-btn-div mt-3">
                <a class="nav-link active rounded-pill py-3 text-center comment-management-btn shadow " aria-current="page"
                    href="{{route('commentManagement')}}">
                    <img src="{{ asset('storage/currentsubscription/Comment.svg') }}">
               {{ __('dashboard.comment_management') }}
                </a>
            </div>


            <div class="div subscription-btn-div mt-3">
                <a class="nav-link active rounded-pill text-center subscription-management-btn py-3    shadow "
                    aria-current="page" href="{{route('currentSubscription')}}" style="background-color: #090835; color: #FFFFFF;">
                    <img src="{{ asset('storage/currentsubscription/subscription.svg') }}">
{{ __('dashboard.subscription_management') }}
                </a>

            </div>
        </div>
        <!-- Button sections end here -->



      <section class="mt-4 container">
    <h2 class="mt-5 mt-lg-4 ms-0 ms-lg-4" style="color: #0A0B2F;">{{ __('dashboard.current_subscription') }}</h2>
    @php
         $userSubscription = auth()->user()->subscriptions()->with('paypalPlan')->first();

    $currentPlanStep = $userSubscription && $userSubscription->paypalPlan ? $userSubscription->paypalPlan->step : null;
    @endphp

    {{-- Row start here --}}
    <div class="row mt-4">
        @foreach ($plans as $plan)
        <div class="col-12 card-columns pb-lg-0 pb-2 mt-3 mt-lg-0 col-md-6 mx-auto col-lg-4 px-0 px-md-3 px-lg-4 border-bottom-sm-screen">
            <div class="card p-4 package-card" @if ($userSubscription && $userSubscription->status === 'ACTIVE' && $userSubscription->plan_id == $plan->id) style="border: solid 0.5rem #7977F4;" @endif>
                <!-- Nested row start -->
                <div class="row box-header">
                    <div class="col-4 mt-2">
                        <img src="{{ asset('storage/currentsubscription/basic.png') }}" class="card-img-top img-fluid images">
                    </div>
                    <div class="col-5 ps-0 mt-2">
                        <h5 class="box-title2 mt-2">{{ __('dashboard.plan_' . strtolower($plan->name)) }}</h5>

                        <span class="dollar">R$</span>
                        <b class="num">{{ $plan->price }} /</b>
                        <span class="dollar">{{ __('dashboard.month') }}</span>
                    </div>

                    <div class="col-3 text-end">
                        <button class="btn popular-btn rounded-pill px-2 py-0">{{ __('dashboard.popular') }}</button>
                    </div>
                </div>
                <!-- Nested row end-->

                <hr class="hr">
                <div class="card-body boxes px-0">
                    @if($plan->name == 'Basic')
                    <ul class="">
                        <li class="list-unstyled mt-0">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.access_hd_content') }}
                        </li>

                        <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.expanded_content_library') }}
                        </li>

                        <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.seamless_content_selection') }}
                        </li>
                         <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.seamless_content_selection2') }}
                        </li>
                    </ul>
                    @elseif($plan->name == 'Standard')
                    <ul class="">
                        <li class="list-unstyled mt-0">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.access_hd_content_standard') }}
                        </li>

                        <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.expanded_content_library') }}
                        </li>

                        <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.seamless_content_selection_standard') }}
                        </li>
                        <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.seamless_content_selection2_standard') }}
                        </li>
                    </ul>
                    @else
                    <ul class="">
                        <li class="list-unstyled mt-0">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.access_hd_content_premium') }}
                        </li>

                        <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                            {{ __('home.expanded_content_library') }}
                        </li>

                        <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                           {{ __('home.seamless_content_selection_premium') }}
                        </li>
                        
                           <li class="list-unstyled mt-4">
                            <i class="fa-solid fa-check"></i>
                           {{ __('home.seamless_content_selection2_premium') }}
                        </li>
                    </ul>
                    @endif
                     
                    @php
    $isSubscriptionActive = $userSubscription && $userSubscription->status === 'ACTIVE' && Carbon\Carbon::now()->lessThan(Carbon\Carbon::parse($userSubscription->expire_date));
@endphp

@if ($isSubscriptionActive && $userSubscription->plan_id == $plan->id)
     
 
    
        <a href="{{ route('subscription.cancel', $userSubscription->id) }}" class="btn fs-5 w-100 py-3">{{ __('dashboard.cancel') }}</a>

@else

   @if($plan->step < $currentPlanStep)
      <button type="button" class="btn fs-5 w-100 py-3" data-bs-toggle="modal" data-bs-target="#payment-modal-{{ $plan->id }}">
            Downgrade
        </button>
    @else
    <button type="button" class="btn fs-5 w-100 py-3" data-bs-toggle="modal" data-bs-target="#payment-modal-{{ $plan->id }}">
        {{ __('dashboard.upgrade') }}
    </button>
    @endif
@endif

                    
                      
                </div>
            </div>
            <hr class="d-block border-4 mt-4 mb-0 d-lg-none d-md-none">
        </div>
        @include('components.select-payment-modal')
        @endforeach
    </div>
    {{-- Row end here --}}
</section>

    </div>
    <script>
        $(document).ready(function() {
    $('.submit-button').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var planId = $(this).data('plan-id'); // Get the plan ID from the button's data attribute
        var actionType = $('#action-type-' + planId).val(); // Get action type with jQuery

        if (actionType === 'downgrade') {
            Swal.fire({
                title: '{{ __("dashboard.are_you_sure_downgrade") }}',
                text: '{{ __("dashboard.downgrade_warning") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __("dashboard.yes_downgrade") }}',
                cancelButtonText: '{{ __("dashboard.no_cancel") }}',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#upgrade-downgrade-form-' + planId).submit(); // Submit the form using jQuery
                }
            });
        } else {
            $('#upgrade-downgrade-form-' + planId).submit(); // Submit the form with jQuery if not downgrade
        }
    });
});
    </script>
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalId = "{{ old('plan_id') }}";
            if (modalId) {
                var modal = new bootstrap.Modal(document.getElementById('payment-modal-' + modalId));
                modal.show();
            }
        });
        
   
      
    </script>
@endif
@endsection
