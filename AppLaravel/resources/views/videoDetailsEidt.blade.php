@extends('layouts.app')

@section('content')
    <style>
        .modal-btn {
            background: transparent !important;
            border: 0 !important;
        }
        .save-btn {
            border-radius: 0.6rem;
            font-size: 0.9rem;
            background-color: #090835 !important;
            color: #FFFFFF !important;
            transition: all 0.3s ease;
            font-weight: 700;
        }

        #copiedMessage, #errorMessage {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 1000;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        #copiedMessage {
            background-color: #26cf6c;
            color: white;
        }

        #errorMessage {
            background-color: #ff3333;
            color: white;
        }
        .updated-btn{
                border-radius: 0.6rem;
    font-size: 0.9rem;
    background-color: #090835 !important;
    color: #FFFFFF;
        margin: 0 0 0 auto;
        padding:10px 30px;
        }
        .updated-btn:hover{
            color: #FFFFFF;
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
.form-control{
    font-size:0.75rem !important;
}
.my-broadcasts-page .view-counter .field input {
    text-align: center !important;
        border: 0 !important;
    margin: 0 auto !important;
}
.channel_name{

    font-size: 0.6rem;
    color: #000000;
    font-weight:500;
        max-height: 1.8rem;
    -webkit-line-clamp: 1;
    display: box;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal;
}
.channel_subs{
        color: #606060;
    margin-right: 4px;

    font-size: 0.6rem;

    font-weight: 400;
    overflow: hidden;
    display: block;
    max-height: 1.8rem;
    -webkit-line-clamp: 1;
    display: box;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal;
}
.image-title {
    font-size: 0.6rem !important;
        display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
.image-text {
    font-size: 0.6rem;

}
.image-text2 {
    font-size: 0.6rem;
        white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width:70px;
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
.service-container{
    width:100%;
}
.sugg-container{
    width:100%;
}
}

        /* Estilos dos templates */
        #instagram-preview-template,
        #youtube-preview-template {
            transition: all 0.3s ease;
        }

        /* Estilo para campos desativados no template do Instagram */
        .instagram-mode .service-container.suggested-videos-container {
            opacity: 0.5;
            pointer-events: none;
            position: relative;
            transition: opacity 0.3s ease;
        }

        .instagram-mode .service-container.suggested-videos-container::after {
            content: "Vídeos sugeridos disponíveis apenas para template do YouTube";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 0.85rem;
            text-align: center;
            z-index: 1000;
            width: 80%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Estilos do Instagram */
        .instagram-mode #saveBtn {
            border-radius: 0.6rem;
            font-size: 0.9rem;
            background-color: var(--navy-color) !important;
            color: var(--light-color);
        }

        #instagram-preview-template .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        #instagram-preview-template .form-control {
            background-color: rgba(0, 0, 0, 0.5) !important;
            color: white;
        }

        #instagram-preview-template .btn:hover {
            opacity: 0.8;
        }

        #instagram-preview-template .rounded-circle {
            border: 2px solid #fff;
        }

        #instagram-preview-template .bg-black {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        @keyframes commentAnimation {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-comment {
            animation: commentAnimation 0.3s ease-out forwards;
            background-color: rgba(0, 0, 0, 0.7) !important;
            border: none;
            backdrop-filter: blur(4px);
        }

        .comments-container {
            max-height: 200px;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
            -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
        }

        .comments-container::-webkit-scrollbar {
            display: none;
        }

        .comment-avatar img {
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        .pulse-ring {
            border: 2px solid #c2ff08;
            border-radius: 50%;
            height: 100%;
            width: 100%;
            animation: pulse 2s cubic-bezier(0.855, 0.03, 0.515, 0.955) infinite;
        }

        /* Estilos do YouTube */
        .video-title {
            font-size: 1.1rem;
            font-weight: 500;
            color: #0f0f0f;
            margin-bottom: 0.5rem;
        }

        .like-share-btns .btn {
            font-size: 0.8rem;
            color: #0f0f0f;
            padding: 0.25rem 0.75rem;
            background-color: #f2f2f2;
        }

        .like-share-btns .btn:hover {
            background-color: #e5e5e5;
        }

        .subscribe-btn {
            font-size: 0.9rem !important;
            padding: 0.5rem 1rem !important;
        }

        .million-btn {
            font-weight: 500;
        }

        .video-description {
            background-color: #f2f2f2;
            border-radius: 0.5rem;
            font-size: 0.9rem;
        }

        /* Responsividade */
        @media screen and (max-width: 767px) {
            .view-counter {
                width: 100% !important;
            }
        }

        @media (min-width: 1024px) and (max-width: 1199px) {
            .service-container {
                width: 100%;
            }
            .sugg-container {
                width: 100%;
            }
        }

        /* Estilos para o embed-responsive */
        .embed-responsive {
            position: relative;
            display: block;
            width: 100%;
            padding: 0;
            overflow: hidden;
        }

        .embed-responsive::before {
            display: block;
            padding-top: 56.25%;
        }

        .embed-responsive .embed-responsive-item,
        .embed-responsive iframe {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Garante que o ytp-cued-thumbnail-overlay seja exibido corretamente */
        .embed-responsive iframe {
            z-index: 1;
        }

        .embed-responsive iframe[src*="youtube.com"] {
            pointer-events: auto;
        }

        /* Ajuste para o container do vídeo do Instagram */
        #instagram-preview-template .video-container {
            position: relative;
            height: calc(100% - 65px) !important; /* Altura total menos a altura do chat */
            overflow: hidden;
        }

        #instagram-preview-template .video-container > div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100% !important;
            padding: 0 !important;
        }

        #instagram-preview-template .video-container > div > img,
        #instagram-preview-template .video-container > div > div {
            height: 100% !important;
        }

        .hidden-element {
            display: none !important;
            visibility: hidden !important;
        }
        
        .inset-0 {
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            position: absolute;
        }
    </style>

    <!--  container fluid start here -->
    <div class="my-broadcasts-page same-top-links-buttons second-page mt-0">




        <!-- Button sections start here -->
        <div class="div  d-lg-flex gap-4 offset-1 ps-2 pe-2 ps-lg-4 mt-4 mt-lg-0 links-section ">

            <div class="div profile-management-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center profile-management-btn py-3   shadow " aria-current="page"
                    href="{{ route('profileManagement') }}">
                    <img src="{{ asset('storage/currentsubscription/Person.svg') }}" style="height: 1.5rem">

                   {{ __('dashboard.profile_management') }}
                </a>
            </div>


            <div class="div my-broadcasts-btn-div mt-3 ">
                <a class="nav-link active rounded-pill text-center py-3   my-broadcasts-btn my-broadcasts-btn-height shadow "
                    aria-current="page" href="{{ route('myBroadcasts') }}"
                    style="background-color: #090835; color: #FFFFFF;">
                    <span class="my-broadcasts-btn-text">
                        <img src="{{ asset('storage/currentsubscription/Stream.svg') }}">
                      {{ __('dashboard.my_broadcasts') }}
                    </span>
                </a>
            </div>


            <div class="div comment-management-btn-div mt-3">
                <a class="nav-link active rounded-pill py-3 text-center comment-management-btn shadow " aria-current="page"
                    href="{{ route('commentManagement') }}">
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
        <section class="mt-4 ">
                   <div style="    display: flex;
    justify-content: space-between;
    align-items:center;
    flex-wrap: wrap;
    ">
               <h2 class="mt-5 mt-lg-4" style="color: #0A0B2F;">{{ __('dashboard.my_broadcasts') }}</h2>


                <div style="width:15rem">
                          <select name="" id="selectedVideo">
            <option value="" selected disabled>{{ __('dashboard.select_broadcast') }}</option>
                    @foreach ($myvideos as $myvideo)
                        <option value="{{ $myvideo->uuid }}" {{ $myvideo->uuid == $video->uuid ? 'selected' : '' }}>{{ $myvideo->details_video_title }}</option>
                    @endforeach
                </select>

                </div>
            </div>
            <div
                style="">



                <div class="row">

                    <div class="col-12 col-lg-3 pt-3 service-container">
                        <form action="{{ route('updateVideo', $video->uuid) }}" method="Post">
                            @method('PUT')
                            @csrf
                            {{-- Card start here --}}
                            <div class="card mt-4  shadow-lg border-0 pb-1">
                                <div class="card-body ">
                                    {{-- @if (Session::has('title'))
                                {{ Session::get('title') }}
                            @endif --}}
                                    <h3 class="card-title m-2">{{ __('dashboard.details') }}</h3>
<h3 class="box-title m-2 mt-3 hidden-element">{{ __('dashboard.template_type') }}</h3>
<div class="div box-div m-2 border py-2 px-3 hidden-element">
                                        <select name="template_type" class="form-control">
                                            <option value="youtube" {{ $video->template_type == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                            <option value="instagram" {{ $video->template_type == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                        </select>
                                    </div>
                                    <h3 class="box-title m-2 mt-3">{{ __('dashboard.video_title') }}</h3>
                                    <div class="div box-div m-2 border  py-2 px-3 ">
                                        <h6 class="box-div-title">{{ __('dashboard.title_required') }}</h6>
                                        <textarea style="font-size:0.75rem !important;" id="videoNameId" name="details_video_title" rows="4"
                                            class="form-control card-text text-area-scroll-bar border-0 p-0 pt-1 video_title"
                                            placeholder="{{ __('dashboard.enter_video_name') }}" style="resize:none;height:0.5rem">{{ $video->details_video_title }}</textarea>

                                        <p id="wordTitleCount" class="text-end card-num ">0/100</p>
                                    </div>
                                    {{-- name field validations errors --}}
                                    <p id="showVideoNameError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;"></p>
                                    @error('details_video_title')
                                        <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
                                    @enderror

                                    <h3 class="box-title ms-2 mt-4">{{ __('dashboard.video_description') }}</h3>
                                    <div class="div box-div m-2 border  py-2 px-3 ">
                                        <h6 class="box-div-title">{{ __('dashboard.details_required') }}</h6>
                                        <textarea id="videoDescriptionId" name="details_video_description"
                                            class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar" placeholder="{{ __('dashboard.enter_video_description') }}"
                                            style="resize:none;">{{ $video->details_video_description }}</textarea>

                                    </div>
                                    <p id="showVideoDescError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;"></p>
                                    @error('details_video_description')
                                        <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
                                    @enderror


                                    <h3 class="box-title ms-2 mt-4">{{ __('dashboard.add_shortcode') }}</h3>
                                    <div class="div box-div m-2 border  py-2 px-3 ">
                                        <h6 class="box-div-title">{{ __('dashboard.shortcode_required') }}</h6>
                                        <textarea id="videoShortCodeId" name="details_video_shortcode"
                                            class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar" placeholder="{{ __('dashboard.enter_video_shortcode') }}"
                                            style="resize:none;">{{ $video->details_video_shortcode }}</textarea>
                                    </div>
                                    <p id="showVideoShortCodeError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;">
                                    </p>
                                    @error('details_video_shortcode')
                                        <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
                                    @enderror

                                    <div class="viewer-counter-section  mx-auto mt-4 ">
                                        <h6 class="view-counter-title">{{ __('dashboard.viewer_counter') }}</h6>



                                        <div class="row">
                                            <div class="col-12">
                                <div class="view-counter" style="width: 80%;">
    <div class="price-input">
        <div class="field border bg-transparent eye-btn text-start btn mt-1 border py-1">
            <span><i class="fa-solid fa-eye"></i></span>
            <input type="number" name="details_video_minimum" id="numMinId"
                   class="input-min bg-transparent eye-btn text-start btn border mt-2 me-1 py-1"
                   value="{{ $video->details_video_minnum }}" />
            <span>{{ __('dashboard.min') }}</span>
        </div>
        <div class="seperator">-</div>
        <div class="field border bg-transparent eye-btn text-start btn mt-1 border py-1">
            <span><i class="fa-solid fa-eye"></i></span>
            <input type="number" name="details_video_maximum" id="numMaxId"
                   class="input-max bg-transparent eye-btn text-start btn border mt-2 me-1 py-1"
                   value="{{ $video->details_video_maxnum }}" />
            <span>{{ __('dashboard.max') }}</span>
        </div>
    </div>

    <div class="slider">
        <div class="progress"></div>
    </div>
    <div class="range-input">
        <input type="range" class="range-min" min="0" max="10000"
               value="{{ $video->details_video_minnum }}" step="100">
        <input type="range" class="range-max" min="0" max="10000"
               value="{{ $video->details_video_maxnum }}" step="100">
    </div>
    <p id="showVideoMaxNumValueError" class="ms-2 mt-1" style="color:red;font-size:0.8rem;"></p>
    @error('details_video_minnum')
        <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
    @enderror
    @error('details_video_maxnum')
        <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
    @enderror
</div>

                                            </div>
                                        </div>

                                       <button type="submit" id="saveBtn" class="btn save-btn shadow mb-2 d-flex py-2 mt-3 updated-btn">
    <span class="mx-auto">{{ __('dashboard.update') }}</span>
</button>




                                    </div>

                                </div>
                            </div>
                            {{-- Card end here --}}


                        </form>
                    </div>
                    <div class="col-12 col-lg-3 service-container">
                        <h3 class="suugested-video-preview-heading mb-2 pb-1 mt-4 mt-lg-0">{{ __('dashboard.suggested_videos') }}</h3>

                        {{-- Card start here --}}
                        <div class="card mt-2 border-0 shadow-lg suggested-videos">
                            @if($video->template_type == 'youtube')
                            <!-- YouTube Template -->
                            <div class="youtube-template">
                                <div class="card-body mt-3">
                                    {{-- Nested Row start here --}}
                                    <div class="row g-3 suggestedvideo">

                                        @foreach ($video->videoThumbnail as $videoThumbnail)
                                            <div class="thbm row mb-4" data-id="{{ $videoThumbnail->id }}">
                                                <div class="col-5 ">

                                                    <img src="{{ asset('storage/' . $videoThumbnail->img_name) }}"
                                                        alt="Uploaded Image" class="uploaded-image"
                                                        style="width:6rem;height:4rem;object-fit:cover;border-radius:5px;">
                                                </div>
                                                <div class="col-6 ">
                                                    <h5 class="image-title">{{ $videoThumbnail->title }}</h5>
                                                    <span
                                                        class="image-text d-block mt-1">{{ $videoThumbnail->description }}</span>
                                                    <input type="text" class="d-none"
                                                        value="{{ $videoThumbnail->title }}" name="sug_video_name[]">
                                                    <input type="text" class="d-none"
                                                        value="{{ $videoThumbnail->title }}" name="sug_video_description[]">
                                                    <span class="image-text d-block">42K views</span>
                                                </div>

                                                <div class="col-1 mt-2 " style="padding-left:0px">
                                                    <button type="button" class="btn btn-primary modal-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-{{ $videoThumbnail->id }}">
                                                        <svg style="width:1rem" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512">
                                                            <path
                                                                d="M373.5 27.1C388.5 9.9 410.2 0 433 0c43.6 0 79 35.4 79 79c0 22.8-9.9 44.6-27.1 59.6L277.7 319l-10.3-10.3-64-64L193 234.3 373.5 27.1zM170.3 256.9l10.4 10.4 64 64 10.4 10.4-19.2 83.4c-3.9 17.1-16.9 30.7-33.8 35.4L24.3 510.3l95.4-95.4c2.6 .7 5.4 1.1 8.3 1.1c17.7 0 32-14.3 32-32s-14.3-32-32-32s-32 14.3-32 32c0 2.9 .4 5.6 1.1 8.3L1.7 487.6 51.5 310c4.7-16.9 18.3-29.9 35.4-33.8l83.4-19.2z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            @include('components.update-modal')
                                        @endforeach
                                    </div>
                                    {{-- Nested Row end here --}}
                                </div>
                            </div>
                            @else
                            <!-- Instagram Template -->
                            <div class="instagram-template">
                                <div class="card-body mt-3">
                                    {{-- Nested Row start here --}}
                                    <div class="row g-3 suggestedvideo">

                                        @foreach ($video->videoThumbnail as $videoThumbnail)
                                            <div class="thbm row mb-4" data-id="{{ $videoThumbnail->id }}">
                                                <div class="col-12 mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('storage/channelAvatar/' . $videoThumbnail->channel_avatar) }}"
                                                             class="rounded-circle me-2" style="width: 40px; height: 40px;" alt="Profile">

                                                        <h6 class="mb-0">{{ $videoThumbnail->channel_name }}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <img src="{{ asset('storage/videothumbnail/' . $videoThumbnail->img_name) }}"
                                                         class="img-fluid rounded" alt="Post Image">
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <p class="mb-0"><strong>{{ $videoThumbnail->channel_name }}</strong> {{ $videoThumbnail->description }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- Nested Row end here --}}
                                </div>
                            </div>
                            @endif
                        </div>
                        {{-- Card end here --}}

                    </div>
                    <div class="col-12 col-lg-6 service-container preview-container">
                        <h3 class="suugested-video-preview-heading mb-2 pb-1 mt-4 mt-lg-0">{{ __('dashboard.preview') }}</h3>

                        @if($video->template_type == 'youtube')
                            <div class="card mt-2 border-0 p-3 shadow-lg" id="youtube-preview-template">
                            {{-- Nested  row1 start here --}}
                            <div class="row video-top-bar px-1 px-lg-0">
                                <div class="col-3 p-0">
                                    <i class="fa-solid fa-bars "></i>
                                    <i class="fa-brands fa-youtube ms-2" style="color: red"></i> <strong
                                        class="text-dark youtube-heading" style="font-size:0.8rem">{{ __('dashboard.youtube') }}</strong>
                                </div>

                                <div class="col-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control py-0 px-1  bg-white border-end-0"
                                            disabled aria-label="Dollar amount (with dot and two decimal places)">
                                        <span class="input-group-text bg-white  p-0 px-2">X</span>

                                        <span class="input-group-text bg-white"
                                            style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
                                            <i class="fa-solid fa-magnifying-glass"></i></span>

                                        <span class="input-group-text ms-2 px-2  rounded-pill bg-light"><i
                                                class="fa-solid fa-microphone"></i></span>
                                    </div>
                                </div>

                                <div class="col-3 text-end gap-2">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-bell mx-lg-2 mx-0"></i>
                                    <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid"
                                        style="height: 1.3rem">
                                </div>
                            </div>
                            {{-- Nested  row1 end here --}}



                            {{-- Nested  row2 start here --}}
                            <div class="row mt-4 gap-0">

                                <div class="col-12 col-lg-8 sugg-container">
                                    {{-- <video height="240" controls autoplay muted>
                                        <source src="movie.mp4" type="video/mp4">
                                        <source src="movie.ogg" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video> --}}
                                    <div class="embed-responsive embed-responsive-16by9">
                                        {!! $video->details_video_shortcode !!}
                                    </div>

                                    {{-- <img src="{{ asset('storage/mybroadcasts/image1.png') }}" class="img-fluid w-100"
                                        height="200" /> --}}


                                    {{-- Row for video title start here --}}
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <h6 class="video-title " id="showName">{{ $video->details_video_title }}
                                            </h6>
                                        </div>
                                    </div>
                                    {{-- Row for video title end here --}}

                                    {{-- Row for share like buttons start here --}}
                                    <div class="row mt-2   space-between like-share-btns">

                                        <div class="col-4 p-0 position-relative">
                                            <div style="padding-left:12px" class="d-flex align-items-center gap-2">
                                <div class="">
                                    <img src="{{ auth()->user()->profile_picture_path ? asset('storage/' . auth()->user()->profile_picture_path) : asset('storage/profile_picture/placeholder-image.jpg') }}" class="img-fluid rounded-full"
                                        style="height:2.5rem;width:2.5rem;object-fit: cover">

                                </div>


                                <div  class="d-flex flex-column">
                                    <div  class="d-flex align-items-center gap-2">
                                            <span class="channel_name"
                                        style="">{{ auth()->user()->name }} </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 0 24 24" width="15" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.8 17.3l-4.2-4.1L7 11.8l2.8 2.7L17 7.4l1.4 1.4-8.6 8.5z" />
                                    </div>

                                    <span class="channel_subs"
                                        style="">14.2M subscribers </span>

                                </div>
                            </div>

                                        </div>
                                        <div class="col-2  justify-content-start p-0">
                                            <button class="btn py-0 bg-dark text-white subscribe-btn rounded-pill "
                                                style="font-size: 0.375rem">Subscribe</button>

                                        </div>

                                        <div class="col-6 px-lg-0 px-2 text-xl-center text-end text-lg-start">
                                            <button class="btn  rounded-pill px-1 million-btn"
                                                style="font-size: 0.4rem"><i class="fa-solid fa-thumbs-up"></i> 2.7M
                                                <i class="fa-solid border-start border-2 ps-2 fa-thumbs-down"></i></button>

                                            <button class="btn rounded-pill "><i
                                                    class="fa-regular fa-share-from-square"></i>
                                                Share</button>
                                            <button class="btn rounded-pill shop-btn"><i
                                                    class="fa-regular fa-bookmark"></i>
                                                Shop</button>
                                            <button class="btn rounded-pill clip-btn "><i
                                                    class="fa-regular fa-bookmark"></i>
                                                Clip</button>
                                            <button class="btn rounded-pill"><i
                                                    class="fa-solid fa-ellipsis-vertical"></i></button>


                                        </div>



                                    </div>
                                    {{-- Row for share like buttons end here --}}

                                    {{-- video description start here --}}
                                    <div class="alert video-description py-1 mt-1">
                                        <span id="showMaxNumValue" class="d-block"
                                            style="color:#0F0F0F;font-size:0.6rem">{{$video->details_video_minnum}} </span>

                                        <span id="showDescription" class="d-block"
                                            style="color:#0F0F0F;font-size:0.6rem">
                                            {{ $video->details_video_description }}
                                        </span>
                                        <span class="d-block" style="color:#0F0F0F;font-size:0.5rem">
                                            <i class="fa-solid fa-arrow-right"></i>
                                            <a href="">https://fanlink.tv/lofigirl-music</a></span>
                                        <span class="d-block" style="color:#0F0F0F;font-size:0.6rem">
                                            ... more
                                        </span>
                                    </div>
                                    {{-- video description end here --}}

                                </div>


                                <div class="col-lg-4 col-lg-4 px-0 pe-2 px-md-3 px-lg-0 sugg-container">
                                    {{-- Top chat card start here --}}
                                    <div class="card" style="border-radius: 0.5rem">
                                        <div class="top-chat-area border-1  px-1 border-bottom">

                                            <button class="btn border-0" style="font-size:0.5rem">{{ __('dashboard.top_chat') }} <i
                                                    class="fa-solid fa-check"></i></button>
                                            <span class="float-end">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                &nbsp;
                                                <i class="fa-solid fa-xmark pe-1"></i>
                                            </span>
                                        </div>

                                        {{-- Live comments section start here --}}
                                        <div class="live-comments mt-0">

                                            @if ($video->videoComment->isEmpty())
                                               <div class="text-white d-inline-block">
                                                    <div class="d-flex align-items-center">
                                                        <div class="comment-avatar me-2 d-flex align-self-center" style="margin-top: 10px;">
                                                            <img src="{{ asset('storage/mybroadcasts/liveturb-coment.png') }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; opacity: 0.5;">
                                                        </div>
                                                        <span class="text-white" style="font-size: 0.8rem;">{{ __('dashboard.no_comments_available') }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ($video->videoComment as $videocomment)
                                                    <div class="row px-2 gap-0">
                                                        <div class="col-3">
                                                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}"
                                                                class="img-fluid">
                                                        </div>
                                                        <div class="col-9 ps-1">
                                                            {{-- Row for  edit and delete buttons start here --}}
                                                            <div class="row">
                                                                <div class="col-9 p-0">
                                                                    <span>{{ $videocomment->comment }}</span>
                                                                </div>

                                                                <div class="col-3 p-0">
                                                                    {{-- <i class="fa-solid fa-ellipsis-vertical"></i> --}}
                                                                    {{-- <button class="btn p-0 opacity-50 pe-1"
                                                                        style="font-size: 0.6rem"> <i
                                                                            class="fa-solid fa-pen"></i></button>

                                                                    <button class="btn p-0 opacity-50 me-1"
                                                                        style="font-size: 0.6rem"><i
                                                                            class="fa-solid fa-trash"></i></button> --}}
                                                                </div>
                                                            </div>
                                                            {{-- Row for  edit and delete buttons end here --}}
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @endif
                                            {{-- Row for live comments start here --}}

                                            {{-- Row for live comments end here --}}


                                        </div>
                                        {{-- Live comments section end here --}}

                                        <div class="alert m-0  p-0 mt-0 rounded-0 mb-0 pb-1 border-top">
                                            <i
                                                class="fa-solid fa-info  pb-2 rounded-0 px-2 py-1 rounded-circle d-inline"></i>
                                            <span class="d-inline" style="color:#424242; font-size:0.7rem">{{ __('dashboard.subscribers_only_mode') }}</span>

                                        </div>
                                    </div>
                                    {{-- Top chat card end here --}}

                                    {{-- short videos section start here --}}
                                    <div class="short-videos mt-2 px-0 ms-1">
                                   <button class="btn px-1 bg-dark py-0 text-white">{{ __('dashboard.all') }}</button>
                    <button class="btn px-1 py-0">{{ __('dashboard.from_your_search') }}</button>
                    <button class="btn px-1 py-0">{{ __('dashboard.from_lofi_girl') }}</button>
                    <button class="btn px-1 py-0">{{ __('dashboard.lo_fl') }}</button>
                                        {{-- Nested Row start here --}}
                                        <div class="row mt-2 g-2 suggestedvideorightside">

                                            {{-- <div class="col-5">
                                                    <img src="{{ asset('storage/mybroadcasts/image1.png') }}"
                                                        class="img-fluid" />
                                                </div>

                                                <div class="col-6 mt-2 pe-2 ">


                                                    <h5 class="image-title" id="showSugVideoName"></h5>
                                                    <span class="image-text mt-1" id="showSugVideoDescription"></span>
                                                    <strong class="d-block" style="font-size: 0.4rem">Sponsored</strong>
                                                </div>

                                                <div class="col-1 p-0 suggeste-video-dropdown ">
                                                    <div class="dropdown p-0">
                                                        <button class="btn bg-transparent p-0 dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>

                                                        </button>
                                                        <ul class="dropdown-menu ps-2" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item btn p-0 opacity-50 pe-1" href="#"
                                                                    style="font-size: 0.6rem"> <i
                                                                        class="fa-solid fa-pen"></i> Edit</a>
                                                            </li>


                                                            <li class="mt-1"><a class="dropdown-item btn p-0 opacity-50 me-1"
                                                                    href="#" style="font-size: 0.6rem">
                                                                    <i class="fa-solid fa-trash"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div> --}}


                                            {{-- <div class="col-5">

                                                <div class="col-5">
                                                    <img src="{{ asset('storage/mybroadcasts/image1.png') }}"
                                                        class="img-fluid" />
                                                </div>

                                                <div class="col-6 mt-2 pe-2">
                                                    <h5 class="image-title">Have A Great Day</h5>
                                                    <span class="image-text mt-1">The Cashmere Collective 42K views</span>
                                                    <strong class="d-block" style="font-size: 0.4rem">Sponsored</strong>
                                                </div>

                                                <div class="col-1 p-0">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </div>


                                                    <img src="{{ asset('storage/mybroadcasts/image1.png') }}"
                                                        class="img-fluid" />
                                                </div>

                                                <div class="col-6 mt-2 pe-2">
                                                    <h5 class="image-title">Have A Great Day</h5>
                                                    <span class="image-text mt-1">The Cashmere Collective 42K views</span>
                                                    <strong class="d-block" style="font-size: 0.4rem">Sponsored</strong>
                                                </div>

                                                <div class="col-1 p-0">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </div>


                                                <div class="col-5">
                                                    <img src="{{ asset('storage/mybroadcasts/image1.png') }}"
                                                        class="img-fluid" />
                                                </div>

                                                <div class="col-6 mt-2 pe-2">
                                                    <h5 class="image-title">Have A Great Day</h5>
                                                    <span class="image-text mt-1">The Cashmere Collective 42K views</span>
                                                    <strong class="d-block" style="font-size: 0.4rem">Sponsored</strong>
                                                </div>

                                                <div class="col-1 p-0">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </div> --}}

                                        </div>
                                        {{-- Nested Row end here --}}

                                    </div>
                                    <div>

                                        @if ($video->videoThumbnail->isEmpty())
                                            <p>Current no suggestion</p>
                                        @else
                                           <h3  style="font-size:18px;" class="suugested-video-preview-heading mb-2 pb-1 mt-4 mt-lg-0 mb-0">Suggested Videos</h3>
                                            <div style="height: 7rem;overflow:auto">
                                                @foreach ($video->videoThumbnail as $videoThumbnail)
                                                    <div class="card-body pt-0">
                                                        <div class="thbm row mb-2 gap-2" data-id="{{ $videoThumbnail->id }}">
                                                            <div class="col-5 p-0">

                                                                <img src="{{ asset('storage/' . $videoThumbnail->img_name) }}"
                                                                    alt="Uploaded Image" class="uploaded-image"
                                                                    style="width:100%;height:4rem;object-fit:cover;border-radius:5px;">
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="image-title">
                                                                    {{ $videoThumbnail->title }}</h5>
                                                                               <div class="d-flex align-items-center mt-1 gap-2">
                    <span class="image-text2 d-block">{{ $videoThumbnail->channel_name }}

                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="10" viewBox="0 0 24 24" width="10" focusable="false" aria-hidden="true" style=""><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.8 17.3l-4.2-4.1L7 11.8l2.8 2.7L17 7.4l1.4 1.4-8.6 8.5z"></path></svg>
                    </div>
                                                                <input type="text" class="d-none"
                                                                    value="{{ $videoThumbnail->title }}"
                                                                    name="sug_video_name[]">
                                                                <input type="text" class="d-none"
                                                                    value="{{ $videoThumbnail->title }}"
                                                                    name="sug_video_description[]">
                                                                <span class="image-text d-block">42K views</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        @endif

                                    </div>

                                    {{-- short videos section end here --}}
                                </div>
                                {{-- short videos section end here --}}


                            </div>
                            {{-- Nested  row end here --}}



                             {{-- <div class="copied-message" id="copiedMessage">Copied!</div> --}}


                        </div>
                        @endif
                        @if($video->template_type == 'youtube')

                        @else
                            <div class="card mt-2 border-0 p-3 shadow-lg" id="instagram-preview-template">
                                <div class="position-relative w-100 mx-auto bg-black" style="aspect-ratio: 9/16; max-width: 400px; overflow: hidden;">
                                    <div class="position-absolute w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), transparent 30%, transparent 40%, rgba(0,0,0,0.8) 80%); pointer-events: none; z-index: 3;"></div>

                                    <div class="w-100 h-100 bg-dark video-container" id="instagram-video-container" style="z-index: 1;">
                                        @if($video->details_video_shortcode)
                                            {!! $video->details_video_shortcode !!}
                                        @endif
                                    </div>

                                    <div class="position-absolute top-0 start-0 end-0 p-4 d-flex align-items-center" style="z-index: 5;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="position-absolute inset-0 pulse-ring"></div>
                                                <div class="position-absolute inset-0 pulse-ring" style="animation-delay: -1s"></div>
                                                <div class="rounded-circle bg-secondary overflow-hidden position-relative" style="width: 40px; height: 40px; z-index: 10;">
                                                    <img src="{{ auth()->user()->profile_picture_path ? asset('storage/' . auth()->user()->profile_picture_path) : asset('storage/profile_picture/placeholder-image.jpg') }}"
                                                        class="w-100 h-100" style="object-fit: cover;">
                                                </div>
                                            </div>
                                            <div>
                                                <h2 id="showName" class="text-white fw-bold mb-0" style="font-size: 0.9rem; max-width: 8.3rem; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">{{ auth()->user()->name }}</h2>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-3 ms-auto">
                                            <span class="bg-danger text-white px-2 py-1 rounded-pill" style="font-size: 0.7rem;">AO VIVO</span>
                                            <div class="bg-black bg-opacity-50 rounded-pill px-2 py-1 d-flex align-items-center gap-1">
                                                <i class="fa-regular fa-eye text-white" style="font-size: 0.8rem;"></i>
                                                <span id="showMaxNumValue" class="text-white" style="font-size: 0.8rem;">{{ $video->details_video_maxnum }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="live-comments-wrapper" style="position: absolute; z-index: 10; bottom: 80px; left: 0; right: 0;">
                                        <div id="live-comments" class="px-4" style="max-height: 60%; overflow-y: auto;">
                                            <div class="d-flex flex-column gap-3 comments-container">
                                                @if ($video->videoComment->isEmpty())
                                                    <div class="text-white d-inline-block">
                                                        <div class="d-flex align-items-center">
                                                            <div class="comment-avatar me-2 d-flex align-self-center" style="margin-top: 10px;">
                                                                <img src="{{ asset('storage/mybroadcasts/liveturb-coment.png') }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; opacity: 0.5;">
                                                            </div>
                                                            <span class="text-white" style="font-size: 0.8rem;">{{ __('dashboard.no_comments_available') }}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach ($video->videoComment as $videocomment)
                                                        <div class="text-white d-inline-block">
                                                            <div class="d-flex">
                                                                <div class="comment-avatar me-2 d-flex align-self-center" style="margin-top: 10px;">
                                                                    <img src="{{ asset('storage/mybroadcasts/liveturb-coment.png') }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                                                                </div>
                                                                <div class="d-flex flex-column">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="text-white fw-bold" style="font-size: 0.9rem;">{{ auth()->user()->name }}</span>
                                                                        <div class="ms-auto">
                                                                            <button class="btn p-0 opacity-50 pe-1 text-white" style="font-size: 0.6rem">
                                                                                <i class="fa-solid fa-pen"></i>
                                                                            </button>
                                                                            <button class="btn p-0 opacity-50 me-1 text-white" style="font-size: 0.6rem">
                                                                                <i class="fa-solid fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span class="text-white" style="font-size: 0.85rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">{{ $videocomment->comment }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-absolute bottom-0 start-0 end-0 p-4 d-flex align-items-center gap-3" style="height: 72px; background: linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0.7), transparent); z-index: 5;">
                                        <input type="text" placeholder="Adicione um comentário..." class="form-control bg-black bg-opacity-50 text-white rounded-pill">
                                        <button class="btn text-white p-0"><i class="fa-regular fa-heart"></i></button>
                                        <button class="btn text-white p-0"><i class="fa-regular fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <button type="button" id="copyBtn"
                            class="btn save-btn shadow mb-2 d-flex mx-auto py-2 px-5 mt-3"
                            data-url="{{ route('video.view', $video->uuid) }}">
                            <span class="mx-auto" id="buttonText">{{ __('dashboard.copy_template') }}</span>
                        </button>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script>
   document.addEventListener("DOMContentLoaded", function () {
    const rangeInput = document.querySelectorAll(".range-input input"),
        priceInput = document.querySelectorAll(".price-input input"),
        range = document.querySelector(".slider .progress");

    let priceGap = 1000;

    // Initialize slider values with min and max from backend
    const minValue = parseInt("{{ $video->details_video_minnum }}");
    const maxValue = parseInt("{{ $video->details_video_maxnum }}");

    rangeInput[0].value = minValue;
    rangeInput[1].value = maxValue;
    priceInput[0].value = minValue;
    priceInput[1].value = maxValue;

    // Update the progress bar on load
    range.style.left = (minValue / rangeInput[0].max) * 100 + "%";
    range.style.right = 100 - (maxValue / rangeInput[1].max) * 100 + "%";

    // Event listeners for manual input changes
    priceInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minPrice = parseInt(priceInput[0].value),
                maxPrice = parseInt(priceInput[1].value);

            if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                if (e.target.className.includes("input-min")) {
                    rangeInput[0].value = minPrice;
                    range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                } else {
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                }
            }
        });
    });

    // Event listeners for range slider changes
    rangeInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minVal = parseInt(rangeInput[0].value),
                maxVal = parseInt(rangeInput[1].value);

            if (maxVal - minVal < priceGap) {
                if (e.target.className.includes("range-min")) {
                    rangeInput[0].value = maxVal - priceGap;
                } else {
                    rangeInput[1].value = minVal + priceGap;
                }
            } else {
                priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
            }
        });
    });
});

    </script>

    <script>
        $(document).ready(function() {
               $("#selectedVideo").on("change", function() {
                let myselected = $(this).val();
                if (myselected) {
                    let url = "{{ route('video.edit', ['uuid' => ':uuid']) }}";
                    url = url.replace(':uuid', myselected);
                    window.location.href = url;
                }
            });

            const select = new SlimSelect({
                select: '#selectedVideo',
                placeholder: '{{ __('dashboard.select_broadcast') }}',
                showSearch: false,
                allowDeselect: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Função para alternar entre os templates
            function toggleTemplates(templateType) {
                if (templateType === 'youtube') {
                    $('#youtube-preview-template').show();
                    $('#instagram-preview-template').hide();
                    $('body').removeClass('instagram-mode');
                    $('#youtubeSaveBtn').removeClass('d-none');
                    $('#instagramSaveBtn').addClass('d-none');
                } else {
                    $('#youtube-preview-template').hide();
                    $('#instagram-preview-template').show();
                    $('body').addClass('instagram-mode');
                    $('#youtubeSaveBtn').addClass('d-none');
                    $('#instagramSaveBtn').removeClass('d-none');
                }
            }

            // Inicializar com o template selecionado
            var initialTemplate = $('select[name="template_type"]').val();
            toggleTemplates(initialTemplate);

            // Alternar templates quando o select mudar
            $('select[name="template_type"]').change(function() {
                toggleTemplates($(this).val());
            });

            // Atualizar título em tempo real
            $('#details_video_title').on('input', function() {
                $('#showName').text($(this).val());
            });

            // Atualizar descrição em tempo real
            $('#details_video_description').on('input', function() {
                $('#showDescription').text($(this).val());
            });

            // Atualizar visualizações em tempo real
            $('#details_video_minnum, #details_video_maxnum').on('input', function() {
                var minNum = $('#details_video_minnum').val();
                var maxNum = $('#details_video_maxnum').val();
                $('#showMaxNumValue').text(minNum + ' - ' + maxNum + ' visualizações');
            });

            // Atualizar shortcode em tempo real
            $('#details_video_shortcode').on('input', function() {
                var shortcode = $(this).val();
                if (initialTemplate === 'youtube') {
                    $('#showShortCodeLink').attr('src', 'https://www.youtube.com/embed/' + shortcode);
                } else {
                    $('#instagram-video-container').html(shortcode);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Função para atualizar o preview do vídeo
            function updateVideoPreview(shortcode) {
                if (shortcode.includes('converteai.net')) {
                    // Se for um código do converteai.net, inserir o código diretamente
                    $('.embed-responsive').html(shortcode);
                } else {
                    // Se for um código do YouTube, usar o iframe
                    $('.embed-responsive').html(`
                        <iframe id="showShortCodeLink" class="rounded-2 embed-responsive-item" width="100%" style="height:19.4rem"
                            src="https://www.youtube.com/embed/${shortcode}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    `);
                }
            }

            // Atualizar shortcode em tempo real
            $('#details_video_shortcode').on('input', function() {
                var shortcode = $(this).val();
                updateVideoPreview(shortcode);
            });

            // Resto do código JavaScript existente...
        });
    </script>

    <script>
        $(document).ready(function() {
            function countAlphanumeric(text) {
    return (text.match(/[a-zA-Z0-9]/g) || []).length;
}

function enforceLimit(text) {
    var alphanumericCount = countAlphanumeric(text);
    if (alphanumericCount > 100) {
        var trimmedText = text.match(/[a-zA-Z0-9]/g).slice(0, 100).join('');
        $('#videoNameId').val(trimmedText);
        return 100;
    }
    return alphanumericCount;
}

function enforceLimit2(text) {
    var alphanumericCount = countAlphanumeric(text);
    if (alphanumericCount > 100) {
        var trimmedText = text.match(/[a-zA-Z0-9]/g).slice(0, 100).join('');
        $('#suggVideoTitleId').val(trimmedText);
        return 100;
    }
    return alphanumericCount;
}

$('#videoNameId').on('input', function() {
    var text = $(this).val();
    var alphanumericCount = enforceLimit(text);
    $('#wordTitleCount').text(alphanumericCount + '/100');
});

//------------------------------------------------------------------------------

$('#copyBtn').on('click', function() {
    var url = $(this).data('url');

    var iframeCode = `
        <style>
            #iframe-container {
                position: relative;
                width: 100%;
                overflow: hidden;
                margin: 0;
                padding: 0;
            }
            #iframe-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: none;
                margin: 0;
                padding: 0;
            }
            @media (max-width: 768px) {
                #iframe-container {
                    min-height: 87vh;
                }
            }
            @media (min-width: 769px) {
                #iframe-container {
                    min-height: 100vh;
                }
            }
        </style>
        <div id="iframe-container">
            <iframe
                src="${url}"
                allowfullscreen>
            </iframe>
        </div>
    `;

    navigator.clipboard.writeText(iframeCode).then(function() {
        $('#buttonText').text('{{ __('dashboard.template_copied') }}');

        if (!$('#copiedMessage').length) {
            $('<div id="copiedMessage">{{ __('dashboard.template_copy_success') }}</div>')
                .appendTo('body')
                .fadeIn()
                .delay(5000)
                .fadeOut(function() {
                    $(this).remove();
                });
        }

        setTimeout(function() {
            $('#buttonText').text('{{ __('dashboard.copy_template') }}');
        }, 5000);
    }).catch(function(error) {
        console.error('Failed to copy iframe code: ', error);

        if (!$('#errorMessage').length) {
            $('<div id="errorMessage">{{ __('dashboard.template_copy_error') }}</div>')
                .appendTo('body')
                .fadeIn()
                .delay(5000)
                .fadeOut(function() {
                    $(this).remove();
                });
        }
    });
});

//------------------------------------------------------------------------------




            $('#videoNameId').on('input', function() {
                $('#showName').text($(this).val());
            });
            $('#videoDescriptionId').on('input', function() {
                $('#showDescription').text($(this).val());
            });
    $('.update-btn').on('click', function() {
    var $modal = $(this).closest('.modal-content');
    var title = $modal.find('.thumb-title').val();
    var description = $modal.find('.thumb-description').val();
    var id = $modal.find('.thumb-id').val();
    var channelName = $modal.find('.thumb-channel-name').val();
    var channelAvatarInput = document.querySelector('#channelAvatar-' + id);
    var channelAvatar = channelAvatarInput.files.length > 0 ? channelAvatarInput.files[0] : null;
    var imageInput = document.querySelector('#inputImage-' + id);
    var image = imageInput.files.length > 0 ? imageInput.files[0] : null;

    var routeUrl = "{{ route('thumb.update', ['id' => '__ID__']) }}";
    var url = routeUrl.replace('__ID__', id);

    var formData = new FormData();
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('title', title);
    formData.append('description', description);
    formData.append('channel_name', channelName);
    if (channelAvatar) {
        formData.append('channel_avatar', channelAvatar);
    }
    if (image) {
        formData.append('image', image);
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                var $row = $('.thbm[data-id="' + id + '"]');
                $row.find('.image-title').text(title);
                $row.find('.image-text.d-block.mt-1').text(description);
                $row.find('.image-text2.d-block').text(channelName);
                if (image) {
                    $row.find('.uploaded-image').attr('src', response.image_url);
                }
                if (channelAvatar) {
                    $row.find('.channel-avatar').attr('src', response.channel_avatar_url);
                }
                $('#modal-close-btn-' + id).click();
                Swal.fire({
                    title: '{{ __("dashboard.success") }}',
                    text: '{{ __("dashboard.thumbnail_updated_successfully") }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = '';

                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages += errors[key] + '\n';
                    }
                }

                Swal.fire({
                    title: '{{ __('dashboard.validation_error') }}',
                    text: errorMessages,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});

        });
    </script>

@endsection
