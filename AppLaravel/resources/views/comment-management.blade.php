@extends('layouts.app')

@section('content')


    <style>
        .toggle-button {
            display: flex;
            align-items: center;
            background-color: #F0F0FF;
            border: 2px solid #A0A0FF;
            border-radius: 25px;
            overflow: hidden;
            width: 300px;
            height: 2.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .comment-management-page .fill-all-fields .btn:focus{
                background-color: #4ee48a !important;
        }

        input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}

        .input-group {
    position: relative;
}

.tick-icon {
    display: none;
    position: absolute;
    right: 10px;
        top: 64%;
    z-index: 20;
    transform: translateY(-50%);
    font-size: 16px;
    color: white;
}
.input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu), .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3) {
     border-top-right-radius: 0.6rem !important;
     border-bottom-right-radius: 0.6rem !important;
}

.show-tick {
    display: inline;
}

        .toggle-option {
            flex: 1;
            text-align: center;
            padding: 10px 0px;
            transition: background-color 0.5s, color 0.3s;
        }

        .option-left {
            background-color: #7977F4;
            color: white;
        }

        .option-right {
            color: #A0A0FF;
            background:white;
        }

        .toggle-button.active .option-left {
            background-color: white;
            color: #A0A0FF;
        }

        .toggle-button.active .option-right {
           background-color: #7977F4;
            color: white;
        }

        .toggle-switch {
            position: absolute;
            top: 50%;
            left: 4px;
            width: 92px;
            height: 30px;
            background-color: #A0A0FF;
            border-radius: 25px;
            transition: left 0.3s;
            transform: translateY(-50%);
        }

        .toggle-button.active .toggle-switch {
            left: 104px;
            background-color: #A0A0FF;
        }

        .container-f {
            text-align: center;
        }

        .range-wrapper-f {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .label-container-f {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 300px;
            margin-bottom: 45px;
            position:relative;
        }

        span#minLabel:after{
            content:'{{ __('dashboard.min') }}';
            position:absolute;
                top: 51px;
    left: 14px;
        }
          span#maxLabel:after{
            content:'{{ __('dashboard.max') }}';
            position:absolute;
                top: 51px;
    right: 14px;
        }
        #minLabel.label,
        #maxLabel.label {
            display: inline-block;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #1f3b93;
            font-weight: bold;
        }

        .sliders-f {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 300px;
        }

        .slider-f {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 10px;
            background: #d3d3d3;
            outline: none;
            border-radius: 5px;
            background: #d3d3d3;
            margin-top: 10px;
        }

        .slider-f::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #1f3b93;
            cursor: pointer;
        }
        span.placeholder{
            background:transparent !important;
            color:#ffffff;
            cursor:pointer;
            opacity:1;
        }
        .ss-content{
            border:0;
        }
        .dropdown-toggle::after{
            content:none !important;
        }
        .ss-content .ss-list{
            box-shadow: 0px 8px 30px 0px #00000040;
            border-radius:6px;
                padding: 0 16px;

        }
        .ss-main .ss-single-selected{
                background-color: #7977F4;
                    padding: 14px 22px;
    height:auto;
    border-radius: 10px;
        }
       .ss-main .ss-single-selected .ss-arrow span{
                    border: solid #fff !important;
                        border-width: 0 2px 2px 0 !important;
        }

        .ss-main .ss-single-selected.ss-open-below {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
.ss-content .ss-list .ss-option {
        border-bottom: 1px solid #D9D9D9;
        padding: 6px 0px;
}
.ss-content .ss-list .ss-option.ss-highlighted, .ss-content .ss-list .ss-option:hover {
    color: #000000;
    background-color: transparent;
}
.ss-main .ss-single-selected .ss-deselect {

    color: #ffff;
}

        /* Estilos específicos para a barra de tempo VSL */
        .vsl-time-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 10px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
            margin: 20px 0;
        }

        .vsl-time-slider:hover {
            opacity: 1;
        }

        .vsl-time-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #7977F4;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .vsl-time-slider::-webkit-slider-thumb:hover {
            background: #090835;
            transform: scale(1.1);
        }

        .vsl-time-slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #7977F4;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .vsl-time-slider::-moz-range-thumb:hover {
            background: #090835;
            transform: scale(1.1);
        }

        .vsl-time-display {
            font-family: Arial, sans-serif;
            margin-top: 15px;
            color: #090835;
            font-weight: 500;
            font-size: 1.2rem;
        }

        .floating-message {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 1000;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .floating-message.fade-out {
            opacity: 0;
        }
    </style>
    <!--  Comment management page start here -->
    <div class="comment-management-page   same-top-links-buttons second-page mt-0">


        <div class="container px-0 ">


        </div>

        <!-- Button sections start here -->
        <div class="div   d-lg-flex gap-4 offset-1 ps-2 pe-2 ps-lg-4 mt-4 mt-lg-0 links-section ">

            <div class="div profile-management-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center profile-management-btn py-3   shadow " aria-current="page"
                    href="{{ route('profileManagement') }}">
                    <img src="{{ asset('storage/currentsubscription/Person.svg') }}" style="height: 1.5rem">

                      {{ __('dashboard.profile_management') }}
                </a>
            </div>


            <div class="div my-broadcasts-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center py-3   my-broadcasts-btn my-broadcasts-btn-height shadow "
                    aria-current="page" href="{{ route('myBroadcasts') }}">
                    <span class="my-broadcasts-btn-text">
                        <img src="{{ asset('storage/currentsubscription/Stream.svg') }}">
                    {{ __('dashboard.my_broadcasts') }}
                    </span>
                </a>
            </div>


            <div class="div comment-management-btn-div mt-3">
                <a class="nav-link active rounded-pill py-3 text-center comment-management-btn shadow " aria-current="page"
                    href="{{ route('commentManagement') }}" style="background-color: #090835; color: #FFFFFF;">
                    <img src="{{ asset('storage/currentsubscription/Comment.svg') }}">
                   {{ __('dashboard.comment_management') }}
                </a>
            </div>


            <div class="div subscription-btn-div mt-3">
                <a class="nav-link active rounded-pill text-center subscription-management-btn py-3    shadow "
                    aria-current="page" href="{{ route('currentSubscription') }}">
                    <img src="{{ asset('storage/currentsubscription/subscription.svg') }}">

                     {{ __('dashboard.subscription_management') }}
                </a>

            </div>
        </div>
        <!-- Button sections end here -->


        <!-- Container start here -->
        <div class="container-fluid p-0">
            <h2 class="mt-5 mt-lg-4" style="color: #0A0B2F;">{{ __('dashboard.comment_management') }}</h2>



            <section class="buttons-sections  mt-3 ">
                {{-- Row start here --}}
                <div class="row">
                    <div class="col-12 col-lg-2">
                        <div class="dropdown">
                            <select id="video-select" class="myselectVideo btn dropdown-toggle dropdown-toggle-btn"
                                style="min-width:10rem; border-radius:10px;color: #000000; font-size: 0.9rem;">
                      <option value="" selected disabled>{{ __('dashboard.select_broadcast') }}</option>
                                @foreach ($videos as $video)
                                    <option value="{{ $video->uuid }}" >{{ $video->details_video_title }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    {{-- col end here --}}

                    <div class="col-12 col-lg-10 pt-3">
                        <div class="toggle-button " onclick="toggleActive()">
                            <div class="toggle-option option-left">{{ __('dashboard.fill_in_all_fields') }}</div>
<div class="toggle-option option-right">{{ __('dashboard.prompt') }}</div>
                        </div>
                    </div>
                    {{-- col end here --}}



                </div>
                {{-- Row end --}}

            </section>


            <div class="card-group mt-5  gap-2 " style="height: auto;">

                {{-- Row start --}}
                <div class="row">

                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 mt-3 mt-lg-0">
                        <div class="card main-card border-0 shadow fill-all-fields disab led"
                            style="border-radius: 20px; background-color: #eeeeee">
                            <div class="card-body ">
                                <h5 class="card-title" style="font-weight: 700;"> Generate Automatic Comments</h5>
                                <form id="cmxform">
                                    <div class="input-group">
                                           <input type="text" name="productName" class="fieldP pname productName btn text-start d-block w-100 mt-3"
    placeholder="{{ __('dashboard.product_name_placeholder') }}">
    <span class="tick-icon"></span>
                                    </div>

<div class="input-group">
    <input type="text" name="productCategory" class="fieldP btn text-start productCategory d-block w-100 mt-2"
    placeholder="{{ __('dashboard.product_category_placeholder') }}">
    <span class="tick-icon"></span>
</div>

<div class="input-group">
<input type="text" name="productDescription" class="fieldP btn text-start productDescription d-block w-100 mt-2"
    placeholder="{{ __('dashboard.product_description_placeholder') }}">
    <span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="productBenefits" class="fieldP btn text-start productBenefits d-block w-100 mt-2"
    placeholder="{{ __('dashboard.product_benefits_placeholder') }}">
    <span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="productPrice" class="fieldP btn productPrice text-start d-block w-100 mt-2"
    placeholder="{{ __('dashboard.product_price_placeholder') }}">
<span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="productOffers" class="fieldP btn text-start productOffers d-block w-100 mt-2"
    placeholder="{{ __('dashboard.product_offers_placeholder') }}">
<span class="tick-icon"></span>
</div>

<div class="input-group">
<input type="number" name="targetAudienceAge" class="fieldP btn text-start targetAudienceAge d-block w-100 mt-2"
    placeholder="{{ __('dashboard.target_audience_age_placeholder') }}">
    <span class="tick-icon"></span>
</div>

<div class="input-group">
<input type="text" name="targetAudienceGender" class="fieldP btn text-start targetAudienceGender d-block w-100 mt-2"
    placeholder="{{ __('dashboard.target_audience_gender_placeholder') }}">
    <span class="tick-icon"></span>
</div>

<div class="input-group">
<input type="text" name="targetAudienceInterests" class="fieldP btn text-start targetAudienceInterests d-block w-100 mt-2"
    placeholder="{{ __('dashboard.target_audience_interests_placeholder') }}">
    <span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="commonProblems" class="fieldP btn text-start commonProblems d-block w-100 mt-2"
    placeholder="{{ __('dashboard.common_problems_placeholder') }}">
    <span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="importantTopics" class="fieldP btn text-start importantTopics d-block w-100 mt-2"
    placeholder="{{ __('dashboard.important_topics_placeholder') }}">
    <span class="tick-icon"></span>
</div>


<div class="input-group">
<input type="text" name="commonQuestions" class="fieldP btn text-start commonQuestions d-block w-100 mt-2"
    placeholder="{{ __('dashboard.common_questions_placeholder') }}">
<span class="tick-icon"></span>
</div>

<div class="input-group">
<input type="text" name="positiveExperiences" class="fieldP btn text-start positiveExperiences d-block w-100 mt-2"
    placeholder="{{ __('dashboard.positive_experiences_placeholder') }}">
<span class="tick-icon"></span>
</div>

<div class="input-group">
<input type="text" name="criticism" class="fieldP btn text-start criticism d-block w-100 mt-2"
    placeholder="{{ __('dashboard.criticism_placeholder') }}">
<span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="incentives" class="fieldP btn text-start incentives d-block w-100 mt-2"
    placeholder="{{ __('dashboard.incentives_placeholder') }}">
<span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="toneOfComments" class="fieldP btn text-start toneOfComments d-block w-100 mt-2"
    placeholder="{{ __('dashboard.tone_of_comments_placeholder') }}">
<span class="tick-icon"></span>
</div>
<div class="input-group">
<input type="text" name="useOfEmojis" class="fieldP btn text-start useOfEmojis d-block w-100 mt-2"
    placeholder="{{ __('dashboard.use_of_emojis_placeholder') }}">
<span class="tick-icon"></span>
</div>
                                </form>
                                <button id="fieldPrompt" class="btn text-start d-block mx-auto mt-4 px-5"
                                    style="background-color: #7977F4 !important; color: #FFFFFF; font-size:0.9rem;border-radius:10px">{{ __('dashboard.save') }}
                                    <i class="fa-solid fa-arrow-right text-white" id="gptIconp"></i>
                                    <img style="width: 1.5rem;display:none" id="loaderimgGptp"
                                        src="{{ asset('storage/gif/loader.gif') }}" alt=""
                                        srcset=""></button>
                                <span class="responseMessagep text-danger"></span>


                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 mt-3 mt-lg-0">
                        <div class="card main-card shadow border-0  " style="border-radius: 20px; ">
                            <div class="card-body px-4">
                      <h5 class="card-title fw-bold">{{ __('dashboard.generate_personalized_comments') }}</h5>
<p style="color: #000120; font-family: arial; font-size:0.875rem">
    {{ __('dashboard.personalized_comments_description') }}
</p>





                                <textarea disabled name="" rows="7" class="fieldT  w-100 mt-3 shadow-light"
                                    style="resize: none;border: 1px solid rgba(0, 0, 0, .125);border-radius: 0.4rem;"></textarea>

                                <span class="responseMessage text-danger"></span>

                                <div class="div mt-4 position-relative px-2 pb-3">
                                    <img src="{{ asset('storage/commentmanagement/chat-gpt.png') }}"
                                        style="height: 2rem;">
                                   <button class="btn py-0 px-1"
    style="background-color: #4EE48A; color: #090835;font-size: 0.8rem;">{{ __('dashboard.ai_chat_button') }}</button>

                                    <!--<img src="{{ asset('storage/commentmanagement/arrow.png') }}"-->
                                    <!--    class="position-absolute end-0" style="height: 3.2rem;">-->
                                    <button id="promtBtn" class="btn  float-end"
                                        style="background-color: #090835;padding:0.5rem 0.875rem;border-radius: 100px;"><i
                                            class="fa-solid fa-arrow-right text-white" id="gptIcon"></i>
                                        <img style="width: 1.5rem;display:none" id="loaderimgGpt"
                                            src="{{ asset('storage/gif/loader.gif') }}" alt="" srcset="">
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 mt-3 mt-lg-0">
                        <div class="card main-card border-0 shadow" style="border-radius: 20px;">
                            <div class="card-body">
                                <div class="messages-container">
                                    <div class="messages" style="height: 620px; overflow-y: auto; padding-right: 10px;">
                                        <!-- Comments will be loaded here -->
                                    </div>
                                    <hr class="m-0 w-100">


                                <div class="frequency-section text-center w-75 mx-auto mt-4">
                                    <div class="container-f">
                                        <h2>DEFINA O TEMPO DA VSL</h2>
                                        <div class="range-wrapper-f">
                                            <input type="range" min="1" max="120" value="60" class="vsl-time-slider" id="vslTimeRange">
                                            <div class="vsl-time-display mt-3">
                                                Tempo total: <strong><span id="vslSelectedTime">60</span> minutos</strong>
                                            </div>
                                            <div class="interval-display mt-2" style="font-size: 0.9rem; color: #666;">
                                                Intervalo entre comentários: <strong><span id="commentInterval">0</span> minutos</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <button id="saveComment" class="btn w-75 text-center mx-auto d-flex justify-content-center mt-4"
                                        style="background-color: #090835; border-radius: 8px; color: #FFFFFF;">{{ __('dashboard.save') }}</button>
                                    <span id="saveCommentMessage"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Row end --}}
                </div>

            </div>

<!-- Edit Comment Modal -->
<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="editCommentModalLabel">{{ __('dashboard.edit_comment_modal_label') }}</h5>
                <button style="background:transparent;border:0;" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="editCommentText" class="form-control" rows="3"></textarea>
            </div>
            <div class="modal-footer">

<button style="background:#7977F4;" type="button" class="btn btn-primary" id="saveCommentChanges">{{ __('dashboard.save_comment_changes_button') }}</button>






            </div>
        </div>
    </div>
</div>



        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
            integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                 const select = new SlimSelect({
        select: '#video-select',
        // placeholder: '{{ __('dashboard.select_broadcast') }}',
        showSearch: false,
        allowDeselect: true
    });

      function checkInputFilled() {
        $('input.fieldP').each(function () {
            let $this = $(this);
            let tickIcon = $this.siblings('.tick-icon');


              if ($this.val().trim() !== "") {
                tickIcon.addClass('show-tick').html('✔');
                // $this.css('background-color', '#3c39d3');
                  $this.attr('style', 'background-color: #4ee48a !important');
            } else {
                tickIcon.removeClass('show-tick').html('');
                // $this.css('background-color', '#7977F4 ');
                        $this.attr('style', 'background-color: #7977F4 !important');
            }
        });
    }

    $('input.fieldP').on('input', function () {
        checkInputFilled();
    });

    checkInputFilled();


                $(".toggle-button").on('click', function() {
                    if ($(this).hasClass('active')) {
                        $('.fieldP').val('');
                        $('.fieldP').prop('disabled', true);
                        $('.fieldT').prop('disabled', false);

                    } else {
                        $('.fieldT').val('');
                        $('.fieldT').prop('disabled', true);
                        // $('#fieldPrompt').prop('disabled', false);
                        $('.fieldP').prop('disabled', false);
                    }
                })

                $("#promtBtn").on('click', function() {
                     $(".responseMessage").text('');
                    let commentLimit = @json(auth()->user()->subscriptions->paypalPlan);
                    let myLimit = commentLimit.comment_limit;

                   let mycurrentlimit = $(".commentsection").length;




                     if($(".fieldT").prop('disabled')){
                        $(".responseMessage").text("{{__('home.promptFieldError')}}");

                     return;
                     }


                    let myselect = $(".myselectVideo").val()
                    if (!myselect) {
                        $('.responseMessage').text("{{ __('dashboard.response_message_select_video') }}");

                        return;
                    }
                      if(myLimit <= mycurrentlimit){
                       $('.responseMessage').text("{{__('home.commentLimitErrro')}}");
                    return;
                   }

                    $("#promtBtn").prop('disabled', true);
                    $("#loaderimgGpt").css('display', 'inline');
                    $("#gptIcon").css('display', 'none');
                    let textarea = $(".fieldT").val();
                    if (textarea.length == 0) {
                        Swal.fire({
    icon: 'warning',
   title: "{{ __('dashboard.swal_title_empty_text') }}",
    text: "{{ __('dashboard.swal_text_empty_text') }}",
    confirmButtonText: 'OK'
});
                        $("#promtBtn").prop('disabled', false);
                            $("#gptIcon").css('display', 'inline');
                              $("#loaderimgGpt").css('display', 'none');
                        return
                    }
                    $.ajax({
                        url: "{{ route('generate.comment') }}", // Replace with your route
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // CSRF token for Laravel
                            prompt: textarea
                        },
                        success: function(response) {
                            $("#promtBtn").prop('disabled', false);
                            $("#loaderimgGpt").css('display', 'none');
                            $("#gptIcon").css('display', 'inline');
                            let comments = response.comments

                            let myremaingLimit =   myLimit-mycurrentlimit

                            if(comments.length >= myremaingLimit){
                               for (let i = 0; i < myremaingLimit ; i++) {
                                    let mycomment = comments[i]
                                let data = `
                       <div class="commentsection" >
                                <div class="d-flex  justify-content-between p-0">
                                    <svg class="mt-2 px-  d-inline" style="height: 2.3rem; width: 2.3rem;"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ff0000"
                                            d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                                    </svg>
                                    <div class="d-flex">
                                        <button class="btn opacity-50 editComment"><i class="fa-solid fa-pen "></i></button>
                                        <button class="btn dellcomment opacity-50 px-1"><i class="fa-solid fa-trash"></i></button></p>
                                    </div>

                                </div>
                                <div>
                                    <span style="color: #424242; font-family: arial; font-size: 0.9rem;">${mycomment}</span>

                                </div>
                                </div>
                            `;
                                $(".messages").append(data);
                               }
                            }else{

                            comments.forEach(function(comment) {
                                let mycomment = comment
                                let data = `
                       <div class="commentsection" >
                                <div class="d-flex  justify-content-between p-0">
                                    <svg class="mt-2 px-  d-inline" style="height: 2.3rem; width: 2.3rem;"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ff0000"
                                            d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                                    </svg>
                                    <div class="d-flex">
                                        <button class="btn opacity-50 editComment"><i class="fa-solid fa-pen "></i></button>
                                        <button class="btn dellcomment opacity-50 px-1"><i class="fa-solid fa-trash"></i></button></p>
                                    </div>

                                </div>
                                <div>
                                    <span style="color: #424242; font-family: arial; font-size: 0.9rem;">${mycomment}</span>

                                </div>
                                </div>
                            `;
                                $(".messages").append(data);
                            })
                            }
                        },
                        error: function(xhr, status, error) {

                            $("#promtBtn").prop('disabled', false);
                            $("#loaderimgGpt").css('display', 'none');
                            $("#gptIcon").css('display', 'inline');
                            $('.responseMessage').text(xhr.responseJSON.message);
                        }
                    });

                })

                $("#cmxform").validate({
                    rules: {
                        productName: "required",
                        productCategory: "required",
                        productDescription: "required",
                        productBenefits: "required",
                        productPrice: "required",
                        productOffers: "required",
                        targetAudienceAge: "required",
                        targetAudienceGender: "required",
                        targetAudienceInterests: "required",
                        commonProblems: "required",
                        importantTopics: "required",
                        commonQuestions: "required",
                        positiveExperiences: "required",
                        criticism: "required",
                        incentives: "required",
                        toneOfComments: "required",
                        useOfEmojis: "required"
                    },
                    messages: {
                       productName: "{{ __('dashboard.product_name_required') }}",
    productCategory: "{{ __('dashboard.product_category_required') }}",
    productDescription: "{{ __('dashboard.product_description_required') }}",
    productBenefits: "{{ __('dashboard.product_benefits_required') }}",
    productPrice: "{{ __('dashboard.product_price_required') }}",
    productOffers: "{{ __('dashboard.product_offers_required') }}",
    targetAudienceAge: "{{ __('dashboard.target_audience_age_required') }}",
    targetAudienceGender: "{{ __('dashboard.target_audience_gender_required') }}",
    targetAudienceInterests: "{{ __('dashboard.target_audience_interests_required') }}",
    commonProblems: "{{ __('dashboard.common_problems_required') }}",
    importantTopics: "{{ __('dashboard.important_topics_required') }}",
    commonQuestions: "{{ __('dashboard.common_questions_required') }}",
    positiveExperiences: "{{ __('dashboard.positive_experiences_required') }}",
    criticism: "{{ __('dashboard.criticism_required') }}",
    incentives: "{{ __('dashboard.incentives_required') }}",
    toneOfComments: "{{ __('dashboard.tone_of_comments_required') }}",
    useOfEmojis: "{{ __('dashboard.use_of_emojis_required') }}",
                    }
                });

                $("#fieldPrompt").on('click', function() {

 let commentLimit = @json(auth()->user()->subscriptions->paypalPlan);
                    let myLimit = commentLimit.comment_limit;

                   let mycurrentlimit = $(".commentsection").length;




                     if($(".productName").prop('disabled')){
                        $(".responseMessagep").text("{{__('home.promptFieldError')}}");

                     return;
                     }
                    $(".responseMessagep").text('');
                    let myselect = $(".myselectVideo").val()
                    if (!myselect) {
                        $('.responseMessagep').text("{{ __('dashboard.response_message_select_video') }}");

                        return;
                    }
                   if(myLimit <= mycurrentlimit){
                       $('.responseMessagep').text("{{__('home.commentLimitErrro')}}");
                    return;
                   }


                    if ($("#cmxform").valid()) {

                        let formData = {};
                        $("#cmxform").find("input").each(function() {
                            formData[$(this).attr("name")] = $(this).val();
                        });
   $("#fieldPrompt").prop('disabled', true);
                    $("#loaderimgGptp").css('display', 'inline');
 $("#gptIconp").css('display', 'inline');
                        $.ajax({
                            url: "{{ route('generate.comment.input') }}", // Replace with your route
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // CSRF token for Laravel
                                prompt: formData
                            },
                            success: function(response) {

                                $("#fieldPrompt").prop('disabled', false);
                                $("#loaderimgGptp").css('display', 'none');

                                                    $("#gptIconp").css('display', 'none');

                                let comments = response.comments

                                // if (comments.length > 3) {
                                //     $("#promtBtn").prop('disabled', true);
                                // }

                                  let myremaingLimit =   myLimit-mycurrentlimit

                            if(comments.length >= myremaingLimit){
                               for (let i = 0; i < myremaingLimit ; i++) {
                                    let mycomment = comments[i]
                                let data = `
                       <div class="commentsection" >
                                <div class="d-flex  justify-content-between p-0">
                                    <svg class="mt-2 px-  d-inline" style="height: 2.3rem; width: 2.3rem;"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ff0000"
                                            d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                                    </svg>
                                    <div class="d-flex">
                                        <button class="btn opacity-50 editComment"><i class="fa-solid fa-pen "></i></button>
                                        <button class="btn dellcomment opacity-50 px-1"><i class="fa-solid fa-trash"></i></button></p>
                                    </div>

                                </div>
                                <div>
                                    <span style="color: #424242; font-family: arial; font-size: 0.9rem;">${mycomment}</span>

                                </div>
                                </div>
                            `;
                                $(".messages").append(data);
                               }
                            }else{

                                comments.forEach(function(comment) {
                                    let mycomment = comment
                                    let data = `
                                    <div class="commentsection" >
                                <div class="d-flex  justify-content-between p-0">
                                    <svg class="mt-2 px-  d-inline" style="height: 2.3rem; width: 2.3rem;"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ff0000"
                                            d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                                    </svg>
                                    <div class="d-flex">
                                        <button class="btn opacity-50 editComment"><i class="fa-solid fa-pen "></i></button>
                                        <button class="btn dellcomment opacity-50 px-1"><i class="fa-solid fa-trash"></i></button></p>
                                    </div>

                                </div>
                                <div>
                                    <span style="color: #424242; font-family: arial; font-size: 0.9rem;">${mycomment}</span>

                                </div>
                                </div>
                        `;
                                    $(".messages").append(data);
                                })
                            }
                            },
                            error: function(xhr, status, error) {

                                $("#fieldPrompt").prop('disabled', false);
                                $("#loaderimgGptp").css('display', 'none');
                                $("#gptIconp").css('display', 'inline');
                                $('.responseMessagep').text(xhr.responseJSON.message);
                            }
                        });

                    }
                })


                $("#saveComment").on('click', function() {
                    let comments = $(".messages div span");
                    let commentarr = [];
                    comments.each(function() {
                        commentarr.push($(this).text());
                    });

                    const totalMinutes = parseInt($('#vslTimeRange').val());
                    const totalComments = $('.commentsection').length || 1;
                    const intervalMinutes = (totalMinutes / totalComments).toFixed(1);

                    // Converter minutos para segundos para o backend
                    const minSec = 2; // Sempre 2 segundos
                    const maxSec = Math.round(intervalMinutes * 60); // Converter minutos para segundos

                    let myselect = $(".myselectVideo").val();
                    if (!myselect) {
                        return;
                    }

                    let url = "{{ route('comment.store', ['uuid' => ':uuid']) }}";
                    url = url.replace(':uuid', myselect);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            commentarr: commentarr,
                            minSec: minSec,
                            maxSec: maxSec,
                            totalMinutes: totalMinutes
                        },
                        success: function(response) {
                            showFloatingMessage('Comments saved successfully');
                            $(".fieldT").val('');
                            $(".fieldP").val('');
                            $(".messages").empty();
                            $("#video-select").val('');
                            $(".ss-deselect").click();
                            $(".myselectVideo option:eq(0)").prop('selected', true);
                        },
                        error: function(xhr, status, error) {
                            showFloatingMessage(xhr.responseJSON.message);

                        }
                    })
                });

                $(".myselectVideo").on('change', function() {
                    let myVal = $(this).val();
                    $(".messages").empty();
                    if (myVal.length > 0) {
                        let url = "{{ route('comments.get', ['uuid' => ':uuid']) }}";
                        url = url.replace(':uuid', myVal);
                        $.ajax({
                            url: url, // Replace with your route
                            type: 'GET',
                            success: function(response) {
                                let comments = response.comments;
                                comments.forEach(function(comment) {
                                    let mycomment = comment.comment
                                    // console.log(mycomment);
                                    let data = `
                                <div class="commentsection">
                                    <div class=" d-flex justify-content-between p-0">
                                    <svg class="mt-2 px-  d-inline" style="height: 2.3rem; width: 2.3rem;"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ff0000"
                                            d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                                    </svg>
                                    <div class="d-flex">
                                        <button class="btn opacity-50 editComment"><i class="fa-solid fa-pen"></i></button>
                                        <button class="dellcomment btn opacity-50 px-1"><i class="fa-solid fa-trash"></i></button></p>
                                    </div>

                                </div>
                                <div>
                                    <span style="color: #424242; font-family: arial; font-size: 0.9rem;">${mycomment}</span>

                                </div>
                                </div>
                            `;
                                    $(".messages").append(data);
                                })
                            },
                            error: function(xhr, status, error) {


                            }
                        })

                    }
                })

                $(document).on('click', '.dellcomment', function() {
                    // Remove the parent comment section of the clicked button
                    $(this).closest('.commentsection').remove();
                });
                $(document).on('click', '.editComment', function() {

                  let currentComment = $(this).closest('.commentsection').find('span').text();

    // Store the comment section element for later use
    let commentSection = $(this).closest('.commentsection');

    // Load the current comment into the modal textarea
    $('#editCommentText').val(currentComment);

    // Show the modal
    $('#editCommentModal').modal('show');

    // Save the edited comment
    $('#saveCommentChanges').off('click').on('click', function() {
        let updatedComment = $('#editCommentText').val();

        // Update the comment in the DOM
        commentSection.find('span').text(updatedComment);

        // Hide the modal
        $('#editCommentModal').modal('hide');
    });
                });

                $('.editComment').on('click', function(){

                });

            })

            function toggleActive() {
                document.querySelector('.toggle-button').classList.toggle('active');
            }

            function removeSurroundingQuotes(str) {
                // Check if the string starts and ends with double quotes
                if (str.startsWith('"') && str.endsWith('"')) {
                    // Remove the surrounding double quotes
                    return str.substring(1, str.length - 1).trim();
                }
                return str.trim();
            }

            $('#vslTimeRange').on('input change', function() {
                $('#vslSelectedTime').text($(this).val());
            });

            // Mantém o código existente do saveComment
            $("#saveComment").on('click', function() {
                // Código existente mantido
            });
        </script>
        <script>
            function showFloatingMessage(message, duration = 5000) {
                // Remove any existing floating messages
                $('.floating-message').remove();

                // Create new message element
                const messageElement = $(`<div class="floating-message">${message}</div>`);
                $('body').append(messageElement);

                // Set timeout to start fade out
                setTimeout(() => {
                    messageElement.addClass('fade-out');
                    // Remove element after fade animation
                    setTimeout(() => {
                        messageElement.remove();
                    }, 500);
                }, duration);
            }
        </script>
        <script>
            $(document).ready(function() {
                function updateCommentInterval() {
                    const totalMinutes = parseInt($('#vslTimeRange').val());
                    const totalComments = $('.commentsection').length || 1;
                    const intervalMinutes = (totalMinutes / totalComments).toFixed(1);

                    // Converter minutos para segundos para o backend
                    const minSec = 2; // Sempre 2 segundos
                    const maxSec = Math.round(intervalMinutes * 60); // Converter minutos para segundos

                    $('#commentInterval').text(intervalMinutes);

                    // Armazenar os valores para uso no saveComment
                    $('#vslTimeRange').data('minSec', minSec);
                    $('#vslTimeRange').data('maxSec', maxSec);
                }

                // Atualizar quando a barra é movida
                $('#vslTimeRange').on('input change', function() {
                    $('#vslSelectedTime').text($(this).val());
                    updateCommentInterval();
                });

                // Atualizar quando o número de comentários muda
                const observer = new MutationObserver(function(mutations) {
                    updateCommentInterval();
                });

                observer.observe($('.messages')[0], {
                    childList: true,
                    subtree: true
                });

                // Atualização inicial
                updateCommentInterval();

                // Modificar o evento de salvar existente
                $("#saveComment").on('click', function() {
                    let comments = $(".messages div span");
                    let commentarr = [];
                    comments.each(function() {
                        commentarr.push($(this).text());
                    });

                    const minSec = $('#vslTimeRange').data('minSec');
                    const maxSec = $('#vslTimeRange').data('maxSec');

                    let myselect = $(".myselectVideo").val();
                    if (!myselect) {
                        return;
                    }

                    let url = "{{ route('comment.store', ['uuid' => ':uuid']) }}";
                    url = url.replace(':uuid', myselect);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            commentarr: commentarr,
                            minSec: minSec,
                            maxSec: maxSec,
                            totalMinutes: $('#vslTimeRange').val()
                        },
                        success: function(response) {
                            // Código existente mantido
                        }
                    });
                });
            });
        </script>
    </div>
    <!--  Comment management page start here -->
@endsection
@push('styles')
<style>
    .comment-item {
        transition: opacity 0.3s ease-in-out;
    }
    
    .comment-item.fade-in {
        opacity: 0;
        animation: fadeIn 0.3s forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .messages::-webkit-scrollbar {
        width: 8px;
    }
    
    .messages::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .messages::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    
    .messages::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush
@push('scripts')
<script>
    // Verificar se o jQuery e o plugin validate estão disponíveis
    if (typeof $ === 'undefined') {
        console.error('jQuery não está disponível');
    } else if (typeof $.fn.validate === 'undefined') {
        console.error('jQuery Validate não está disponível');
    } else {
        console.log('jQuery e jQuery Validate estão disponíveis');
    }
</script>
<script src="{{ asset('js/comment-management.js') }}?v={{ time() }}"></script>
@endpush
