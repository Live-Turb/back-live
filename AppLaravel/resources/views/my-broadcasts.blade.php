@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('storage/css/my-broadcasts.css') }}" />
    
    <style>
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
.channel_name{
   
    font-size: 0.6rem;
    color: #000000;
    font-weight:500;
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
    max-width:120px;
}
   @media screen and (max-width: 767px) {
       .view-counter{
           width:100% !important;
       }

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
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/youtube-preview.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Inicializa o estado baseado no template selecionado
            const initialTemplate = $('#templateSelector').val();
            $('#instagram-preview-template').hide();
            $('#youtubeSaveBtn').addClass('d-none');
            toggleTemplates(initialTemplate);
            
            // Função para alternar templates
            function toggleTemplates(template) {
                const $youtubeTemplate = $('#youtube-preview-template');
                const $instagramTemplate = $('#instagram-preview-template');
                const $page = $('.my-broadcasts-page');
                const $inputs = $('.service-container.suggested-videos-container input, .service-container.suggested-videos-container textarea');
                const $uploadBtn = $('#uploadBtn');
                const $saveBtn = $('#saveBtn');
                
                const $youtubeSaveBtn = $('#youtubeSaveBtn');

                if (template === 'youtube') {
                    $youtubeTemplate.fadeIn();
                    $instagramTemplate.fadeOut();
                    $page.removeClass('instagram-mode');
                    $inputs.prop('disabled', false);
                    $uploadBtn.removeClass('d-none');
                    $saveBtn.addClass('d-none');
                    $youtubeSaveBtn.removeClass('d-none');
                    
                    // Restaura os valores dos campos se necessário
                    $inputs.each(function() {
                        const $input = $(this);
                        const savedValue = $input.data('saved-value');
                        if (savedValue !== undefined) {
                            $input.val(savedValue);
                        }
                    });
                } else if (template === 'instagram') {
                    $youtubeTemplate.fadeOut();
                    $instagramTemplate.fadeIn();
                    $page.addClass('instagram-mode');
                    $uploadBtn.addClass('d-none');
                    $saveBtn.removeClass('d-none');
                    $youtubeSaveBtn.addClass('d-none');
                    
                    // Salva os valores atuais antes de desabilitar
                    $inputs.each(function() {
                        const $input = $(this);
                        $input.data('saved-value', $input.val());
                    });
                    
                    $inputs.prop('disabled', true);
                }
            }

            // Evento change do selector
            $('#templateSelector').on('change', function() {
                var selectedTemplate = $(this).val();
                // Atualiza o valor do template no input hidden
                $('#selectedTemplateInput').val(selectedTemplate);
                toggleTemplates(selectedTemplate);
            });
        });
    </script>
    <style></style>
    <!--  container fluid start here -->
    <div class="my-broadcasts-page same-top-links-buttons second-page mt-0">


 


        <!-- Button sections start here -->
        <div class="div  d-lg-flex gap-4 offset-1 ps-2 pe-2 mt-4 mt-lg-0 links-section align-items-center">

      <div class="div profile-management-btn-div mt-3 ">
    <a class="nav-link active rounded-pill text-center profile-management-btn py-3 shadow" aria-current="page"
        href="{{ route('profileManagement') }}">
        <img src="{{ asset('storage/currentsubscription/Person.svg') }}" style="height: 1.5rem">
        {{ __('dashboard.profile_management') }}
    </a>
</div>

<div class="div my-broadcasts-btn-div mt-3 ">
    <a class="nav-link active rounded-pill text-center py-3 my-broadcasts-btn my-broadcasts-btn-height shadow"
        aria-current="page" href="{{ route('myBroadcasts') }}" style="background-color: #090835; color: #FFFFFF;">
        <span class="my-broadcasts-btn-text">
            <img src="{{ asset('storage/currentsubscription/Stream.svg') }}">
            {{ __('dashboard.my_broadcasts') }}
        </span>
    </a>
</div>

<div class="div comment-management-btn-div mt-3">
    <a class="nav-link active rounded-pill py-3 text-center comment-management-btn shadow" aria-current="page"
        href="{{ route('commentManagement') }}">
        <img src="{{ asset('storage/currentsubscription/Comment.svg') }}">
        {{ __('dashboard.comment_management') }}
    </a>
</div>

<div class="div subscription-btn-div mt-3">
    <a class="nav-link active rounded-pill text-center subscription-management-btn py-3 shadow"
        aria-current="page" href="{{ route('currentSubscription') }}">
        <img src="{{ asset('storage/currentsubscription/subscription.svg') }}">
        {{ __('dashboard.subscription_management') }}
    </a>
</div>

        </div>
        <!-- Button sections end here -->



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
                        <option value="{{ $myvideo->uuid }}">{{ $myvideo->details_video_title }}</option>
                    @endforeach
                </select>

                </div>
            </div>
            <form action="{{ route('storeVideo') }}" method="POST" id="formId" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="selected_template" id="selectedTemplateInput" value="youtube">
                <div style="display: none" class="imagedataclass"></div>
                {{-- Row start here --}}

                <div class="row">
                    @if ($isLimit)
                        <div class="col-12 col-lg-6">
                            <img style="width: -webkit-fill-available; height: 37rem; border-radius: 18px;"
                src="{{ asset('storage/mybroadcasts/fulllimit.jpeg') }}" alt="" srcset="">
                        </div>
                    @else
                        <div class="col-12 col-lg-3 pt-3 service-container">
                            {{-- Card start here --}}
                            <div class="card mt-4  shadow-lg border-0 pb-1">
                                <div class="card-body ">
                                    {{-- @if (Session::has('title'))
                                {{ Session::get('title') }}
                            @endif --}}
                                    <!--<h3 class="card-title m-2">Details</h3>-->
                                    <!--<h3 class="box-title m-2 mt-3">Video Title</h3>-->
                                    <!--<div class="div box-div m-2 border  py-2 px-3 ">-->
                                    <!--    <h6 class="box-div-title">Title Required*</h6>-->
                                    <!--    <textarea id="videoNameId" name="details_video_title"-->
                                    <!--    rowspan="4"-->
                                    <!--        class="form-control card-text text-area-scroll-bar border-0 p-0 pt-1" placeholder="Enter your video name"-->
                                    <!--        style="resize:none;">{{ old('details_video_title') }}</textarea>-->

                                    <!--    <p id="wordTitleCount" class="text-end card-num ">0/100</p>-->
                                    <!--</div>-->
                                    <!--{{-- name field validations errors --}}-->
                                    <!--<p id="showVideoNameError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;"></p>-->
                                    <!--@error('details_video_title')-->
                                    <!--    <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>-->
                                    <!--@enderror-->

                                    <!--<h3 class="box-title ms-2 mt-4">Video Description</h3>-->
                                    <!--<div class="div box-div m-2 border  py-2 px-3 ">-->
                                    <!--    <h6 class="box-div-title">Details Required*</h6>-->
                                    <!--    <textarea id="videoDescriptionId" name="details_video_description"-->
                                    <!--        class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar" placeholder="Enter your video description"-->
                                    <!--        style="resize:none;">{{ old('details_video_description') }}</textarea>-->

                                    <!--</div>-->
                                    <!--<p id="showVideoDescError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;"></p>-->
                                    <!--@error('details_video_description')-->
                                    <!--    <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>-->
                                    <!--@enderror-->


                                    <!--<h3 class="box-title ms-2 mt-4">Add a Short code</h3>-->
                                    <!--<div class="div box-div m-2 border  py-2 px-3 ">-->
                                    <!--    <h6 class="box-div-title">Short code Required*</h6>-->
                                    <!--    <textarea id="videoShortCodeId" name="details_video_shortcode"-->
                                    <!--        class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar" placeholder="Enter your video short code"-->
                                    <!--        style="resize:none;">{{ old('details_video_shortcode') }}</textarea>-->
                                    <!--</div>-->
                                    <!--<p id="showVideoShortCodeError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;">-->
                                    <!--</p>-->
                                    <!--@error('details_video_shortcode')-->
                                    <!--    <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>-->
                                    <!--@enderror-->
                                    
                                    
                                    
                                    <h3 class="card-title m-2">{{ __('dashboard.details') }}</h3>

<h3 class="box-title m-2 mt-3">{{ __('dashboard.video_title') }}</h3>
<div class="div box-div m-2 border py-2 px-3">
    <h6 class="box-div-title">{{ __('dashboard.title_required') }}</h6>
    <textarea style="font-size:0.75rem !important;" id="videoNameId" name="details_video_title" rows="4"
        class="form-control card-text text-area-scroll-bar border-0 p-0 pt-1"
        placeholder="{{ __('dashboard.enter_video_name') }}"
        style="resize:none;">{{ old('details_video_title') }}</textarea>

    <p id="wordTitleCount" class="text-end card-num">0/100</p>
</div>
{{-- name field validations errors --}}
<p id="showVideoNameError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;"></p>
@error('details_video_title')
    <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
@enderror

<h3 class="box-title ms-2 mt-4">{{ __('dashboard.video_description') }}</h3>
<div class="div box-div m-2 border py-2 px-3">
    <h6 class="box-div-title">{{ __('dashboard.details_required') }}</h6>
    <textarea id="videoDescriptionId" name="details_video_description"
        class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar"
        placeholder="{{ __('dashboard.enter_video_description') }}"
        style="resize:none;">{{ old('details_video_description') }}</textarea>
</div>
<p id="showVideoDescError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;"></p>
@error('details_video_description')
    <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
@enderror

<h3 class="box-title ms-2 mt-4">{{ __('dashboard.add_shortcode') }}</h3>
<div class="div box-div m-2 border py-2 pb-4 px-3">
    <h6 class="box-div-title">{{ __('dashboard.shortcode_required') }}</h6>
    <textarea id="videoShortCodeId" name="details_video_shortcode"
        class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar"
        placeholder="{{ __('dashboard.enter_video_shortcode') }}"
        style="resize:none;">{{ old('details_video_shortcode') }}</textarea>
</div>
<p id="showVideoShortCodeError" class="ms-2 mt-0" style="color:red;font-size:0.8rem;"></p>
@error('details_video_shortcode')
    <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">{{ $message }}</p>
@enderror


                                    <div class="viewer-counter-section  mx-auto mt-4 ">
                                       <h6 class="view-counter-title">{{ __('dashboard.viewer_counter') }}</h6>



                                        <div class="row">
                                            <div class="col-12">
                                                <div class="view-counter" style="width: 80%;">

                                                    <div class="price-input">
                                                        <div
                                                            class="field border bg-transparent eye-btn text-start btn mt-1 border py-1 ">
                                                            <span><i class="fa-solid fa-eye"></i></span>


                                                            <input type="number" name="details_video_minimum"
                                                                id="numMinId" class="input-min"
                                                                value="{{ old('details_video_minimum') }}"
                                                                class="bg-transparent eye-btn text-start btn border mt-2 me-1 py-1" />
                                                                <br>
                                    <span>{{ __('dashboard.min') }}</span>                       
                                                        </div>
                                                        <div class="seperator">-</div>
                                                        <div
                                                            class="field border bg-transparent eye-btn text-start btn mt-1 border py-1">
                                                            <span>
                                                                <i class="fa-solid fa-eye"></i>
                                                            </span>
                                                            <input type="number"
                                                                value="{{ old('details_video_maximum') }}"
                                                                name="details_video_maximum" id="numMaxId"
                                                                class="input-max " value="100000" />
<span>{{ __('dashboard.max') }}</span> 
                                                        </div>

                                                    </div>


                                                    <div class="slider">
                                                        <div class="progress"></div>
                                                    </div>
                                                    <div class="range-input">
                                                        <input type="range" class="range-min" min="0"
                                                            max="10000" value="2500" step="100">
                                                        <input type="range" class="range-max" min="0"
                                                            max="10000" value="7500" step="100">

                                                    </div>
                                                    <p id="showVideoMaxNumValueError" class="ms-2 mt-1"
                                                        style="color:red;font-size:0.8rem;"></p>
                                                        <p id="showVideoMinNumValueError" class="ms-2 mt-1"
                                                        style="color:red;font-size:0.8rem;"></p>
                                                    @error('details_video_minimum')
                                                        <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">
                                                            {{ $message }}</p>
                                                    @enderror
                                                    @error('details_video_maximum')
                                                        <p class="ms-2 mt-0" style="color:red;font-size:0.8rem;">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

<div class="row" bis_skin_checked="1">
            <div class="col-12" bis_skin_checked="1">
                <div class="view-counter mb-3" style="width: 80%;" bis_skin_checked="1">
                    <label for="templateSelector" class="form-label" style="font-size: 14px; color: #333; margin-bottom: 8px;">Selecione o Template:</label>
                    <select id="templateSelector" name="template_selector" class="form-control" style="background-color: #7977F4; padding: 14px 22px; height: auto; border-radius: 10px; color: white; border: none; cursor: pointer; width: 100%; font-size: 14px;">
                        <option value="youtube">YouTube</option>
                        <option value="instagram">Instagram</option>
                    </select>
                </div>
            </div>
        </div>

                                        <div class="button-container float-end">
                                            <button type="button" id="uploadBtn"
                                                class="btn upload-btn shadow mb-2 py-2 mt-4">
                                                {{ __('dashboard.upload_button') }}  <i class="fa-solid fa-upload ms-1"></i>
                                            </button>

                                            <button type="button" id="saveBtn" 
                                                class="btn save-btn shadow mb-2 d-none py-2 mt-4">
                                                <span class="mx-auto">{{ __('dashboard.save_button') }}</span>
                                            </button>
                                        </div>



                                    </div>

                                </div>
                            </div>
                            {{-- Card end here --}}


                        </div>



                 <div class="col-12 col-lg-3 service-container suggested-videos-container">
    <h3 class="suugested-video-preview-heading mb-2 pb-1 mt-4 mt-lg-0">{{ __('dashboard.suggested_videos') }}</h3>

    {{-- Card start here --}}
    <div class="card mt-2 border-0 shadow-lg suggested-videos">

        <div class="card-body mt-3">
            {{-- Nested Row start here --}}
            <div class="row g-3 suggestedvideo"></div>

            {{-- Nested Row end here --}}
            <hr class="border border-2">

            <input type="file" class="d-none" id="inputImage">

            <label for="inputImage" class="btn form-control w-100 shadow py-2 text-center thumbnail-btn">
                {{ __('dashboard.add_thumbnail') }}
                <img src="{{ asset('storage/mybroadcasts/thumbnail.png') }}" class="h-75 mx-1">
            </label>

            <p id="showSugVideoThumbnailImgError" class="ms-2 ps-1 mt-2" style="color:red;font-size:0.8rem;"></p>

            <h3 class="box-title m-2 mt-3">{{ __('dashboard.video_title') }}</h3>
            <div class="div box-div m-2 border py-2 px-3">
                <h6 class="box-div-title">{{ __('dashboard.title_required') }}</h6>
                <textarea id="suggVideoTitleId" class="form-control card-text text-area-scroll-bar border-0 p-0 pt-1"
                    placeholder="{{ __('dashboard.enter_video_name') }}" rows="3" style="resize:none;"></textarea>
                <p id="suggestedTitle" class="text-end card-num ">0/100</p>
            </div>
            <p id="showSugVideoNameError" class="ms-2 ps-1 mt-0" style="color:red;font-size:0.8rem;"></p>

            <h3 class="box-title ms-2 mt-4">{{ __('dashboard.video_description') }}</h3>
            <div class="div box-div m-2 border py-2 pb-4 px-3">
                <h6 class="box-div-title">{{ __('dashboard.details_required') }}</h6>
                <textarea id="suggVideoDescId" class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar"
                    placeholder="{{ __('dashboard.enter_video_description') }}" style="resize:none;"></textarea>
            </div>
            <p id="showSugVideoDescError" class="ms-2 ps-1 mt-0" style="color:red;font-size:0.8rem;"></p>
            
            
            
            <h3 class="box-title ms-2 mt-4">{{ __('dashboard.channel_name') }}</h3>
<div class="div box-div m-2 border py-2 pb-4 px-3">
    <h6 class="box-div-title">{{ __('dashboard.channel_name_required') }}*</h6>
    <input type="text" id="channelNameId" class="form-control card-text border-0 p-0 pt-1" 
           placeholder="{{ __('dashboard.enter_channel_name') }}" />
</div>
<p id="showChannelNameError" class="ms-2 ps-1 mt-0" style="color:red;font-size:0.8rem;"></p>

<h3 class="box-title ms-2 mt-4">{{ __('dashboard.channel_avatar') }}</h3>
<div class="div box-div m-2 border py-2 pb-4 px-3">
    <h6 class="box-div-title">{{ __('dashboard.channel_avatar_required') }}*</h6>
    <input type="file" id="channelAvatarId" class="form-control" />
</div>
<p id="showChannelAvatarError" class="ms-2 ps-1 mt-0" style="color:red;font-size:0.8rem;"></p>


            <div class="d-flex flex-column">
                <button type="button" id="addBtnClick"
                    class="btn thumbnail-btn float-end rounded-3 py-1 px-2 text-white" style="cursor: pointer">
                    <style>
                        .loader {
    border: 2px solid #f3f3f3;
    border-top: 2px solid #3498db; 
    border-radius: 50%;
    width: 16px;
    height: 16px;
    animation: spin 1s linear infinite;
    display: inline-block;
    vertical-align: middle;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

                    </style>
                    {{ __('dashboard.add_button') }}
                    <span class="loader d-none"></span>
                </button>

                <button type="button" id="youtubeSaveBtn" 
                    class="btn save-btn shadow mb-2 mt-3 py-2 text-center d-none"
                    style="background-color: #090835; color: white; border-radius: 0.6rem; font-size: 0.9rem;">
                    <span class="mx-auto">{{ __('dashboard.save_button') }}</span>
                </button>
            </div>
            <br>

        </div>
    </div>
    {{-- Card end here --}}
</div>

                    @endif
                    <div class="col-12 col-lg-6 service-container preview-container">
                        <h3 class="suugested-video-preview-heading mb-2 pb-1 mt-4 mt-lg-0">{{ __('dashboard.preview') }}</h3>
                        
                        <x-youtube-template
                            :videoTitle="old('details_video_title', 'VEJA COMO FUNCIONA A PLATAFORMA')"
                            :videoDescription="old('details_video_description', '')"
                            :channelName="old('channel_name', auth()->user()->name ?? '')"
                            :viewCount="old('view_count', '0')"
                            :shortCode="old('details_video_shortcode', '_W9R2czlRtE')"
                        />

                        <x-instagram-template
                            :videoTitle="old('details_video_title', 'Live no Instagram')"
                            :channelName="old('channel_name', auth()->user()->name ?? '')"
                            :viewCount="old('view_count', '1.000')"
                            :comments="[
                                ['username' => 'Antonio Monteiro', 'message' => 'To Adorando essa live Pra cima '],
                                ['username' => 'Julia Santos', 'message' => 'Perfect timing for this! I\'m so excited.'],
                                ['username' => 'Carlos Silva', 'message' => 'Great explanations, really helpful.'],
                                ['username' => 'Maria Costa', 'message' => 'Conteudo Topp'],
                                ['username' => 'Pedro Alves', 'message' => 'Absolutely love this, can\'t wait to buy.'],
                                ['username' => 'Ana Paula', 'message' => 'This live stream is so informative, thank you!'],
                                ['username' => 'Lucas Mendes', 'message' => 'Cade o botao de Compra quero Comprar!!']
                            ]"
                        />

                    </div>
                    {{-- Nested  row2 end here --}}

                </div>
                {{-- Row end here --}}

            </form>
        </section>
    </div>

    {{-- Script for preview image --}}
    {{-- <script>
        var inputImage = document.getElementById("inputImage");
        var previewimg = document.getElementById("previewImage");
        inputImage.addEventListener("change", function(event) {
            if (event.target.files.length == 0) {
                return;
            } else {
                var tmpUrl = URL.createObjectURL(event.target.files[0]);
                previewimg.setAttribute("src", tmpUrl);
            }
        });
    </script> --}}

    {{-- Script for viewer counter --}}
    <script>
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");

        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
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
    </script>

    {{-- Script for details form --}}
    <script>
        $(document).ready(function() {

            $("#selectedVideo").on("change", function() {
                let myselected = $(this).val();
                if (myselected) {
                    let url = "{{ route('video.edit', ['uuid' => ':uuid']) }}";
                    url = url.replace(':uuid', myselected);
                    window.location.href = url;
                }
            })

            $("#uploadBtn").click(function(event) {

                // alert("aaaa");
                let nameValue = $("#videoNameId").val();
                let descriptionValue = $("#videoDescriptionId").val();
                let shortCodeValue = $("#videoShortCodeId").val();
                let maxNumValue = $("#numMaxId").val();
                // alert(name);

          if (nameValue.length < 1) {
    $("#showVideoNameError").text("{{ __('dashboard.video_name_required') }}");
}
if (nameValue.length < 2 || nameValue.length > 100) {
    $("#showVideoNameError").text("{{ __('dashboard.video_name_length') }}");
}
if (descriptionValue.length < 1) {
    $("#showVideoDescError").text("{{ __('dashboard.video_description_required') }}");
}
if (shortCodeValue.length < 1) { // This line checks the short code value
    $("#showVideoShortCodeError").text("{{ __('dashboard.video_shortcode_required') }}");
}
if (maxNumValue.length < 1) {
    $("#showVideoMaxNumValueError").text("{{ __('dashboard.max_value_required') }}");
}

                if (nameValue && descriptionValue && shortCodeValue) {
                    $("#showName").text(nameValue);
                    $("#showDescription").text(descriptionValue);
                    $(".embed-responsive-16by9").html(shortCodeValue);
                    // $("#showShortCodeLink").attr("src", shortCodeValue);
                    $("#showMaxNumValue").text(maxNumValue);

                }


                // let showError = $("#videoNameId").attr("required", true);

            });
        });
    </script>

    {{-- Script for addclickbtn form --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
    
$("#addBtnClick").on('click', function() {
    let title = $("#suggVideoTitleId").val();
    let description = $("#suggVideoDescId").val();
    let channelName = $("#channelNameId").val();
    let inputimg = $("#inputImage")[0].files[0];
    let channelAvatar = $("#channelAvatarId")[0].files[0];

    // Validate fields
    let valid = true;

    if (title.length < 1 || title.length < 2 || title.length > 100) {
        $("#showSugVideoNameError").text("{{ __('dashboard.video_name_required') }}");
        valid = false;
    } else {
        $("#showSugVideoNameError").text('');
    }

    if (description.length < 1) {
        $("#showSugVideoDescError").text("{{ __('dashboard.video_description_required') }}");
        valid = false;
    } else {
        $("#showSugVideoDescError").text('');
    }

    if (!channelName) {
        $("#showChannelNameError").text("{{ __('dashboard.channel_name_required') }}");
        valid = false;
    } else {
        $("#showChannelNameError").text('');
    }

    if (!inputimg) {
        $("#showSugVideoThumbnailImgError").text("{{ __('dashboard.thumbnail_image_error') }}");
        valid = false;
    } else {
        $("#showSugVideoThumbnailImgError").text('');
    }

    if (!channelAvatar) {
        $("#showChannelAvatarError").text("{{ __('dashboard.channel_avatar_required') }}");
        valid = false;
    } else {
        $("#showChannelAvatarError").text('');
    }

    if (!valid) {
        return; // Stop execution if validation fails
    }

    let $button = $(this);
    var formData = new FormData();
    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
    formData.append("title", title);
    formData.append("description", description);
    formData.append("inputimg", inputimg); // Append the file
    formData.append("channel_name", channelName);
    formData.append("channel_avatar", channelAvatar); // Append the channel avatar file

            // Get selected platform from template selector
            let platform = $('#templateSelector').val();
            
            $.ajax({
                url: "{{ route('store.thumbnail.img') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

        beforeSend: function() {
            $button.find('.loader').removeClass('d-none');
        },
     success: function(response) {
    $button.find('.loader').addClass('d-none');

    // Handle success response
    let imgdata = `<input type="text" name="imgdata[]" class="thumbnailimginput" mythumbid="${response.data.id}" value="${response.data.id}">`;
    $('.imagedataclass').append(imgdata);

    if (title && description && inputimg) {
        $("#whenNovideo").css("display", "none");
        $("#whenNoTitle").css("display", "none");
        $("#whenNoData").css("display", "none");
        $("#whenNoId").removeClass("when-no-video");
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        let imageSrc = e.target.result;
            let data = `
                <div class="parentSecImg d-flex" boxidstore="${response.data.id}">
                    <div class="col-4">
                        <img src="${imageSrc}" alt="Uploaded Image" class="uploaded-image" style="width:6rem;height:4rem;object-fit:cover;border-radius:5px;">
                    </div>
                    <div class="col-7">
                        <h5 class="image-title">${title}</h5>
                        <span class="image-text d-block mt-1">${description}</span>
                  
                        <input type="text" class="d-none" value="${title}" name="sug_video_name[]">
                        <input type="text" class="d-none" value="${description}" name="sug_video_description[]">
                        <input type="text" class="d-none" value="${response.data.channel_name}" name="channel_name[]">
                        <input type="text" class="d-none" value="${response.data.channel_avatar}" name="channel_avatar[]">
                        <input type="text" class="d-none" value="${platform}" name="platform[]">
                        <span class="image-text d-block">42K views</span>
                    </div>
                    <div class="col-2 mt-2" style="padding-left:0px">
                       <a href="javascript:void(0)" class="dellbtn d-flex justify-content-center">
                           <svg style="width:1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                               <path fill="#ff0000" d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304c0-17.7-14.3-32-32-32z"/>
                           </svg>
                       </a>
                    </div>
                </div>
            `;

        let dataO = `
            <div class="parentSecImg d-flex mb-1" boxidstore="${response.data.id}">
                <div class="col-4">
                    <img src="${imageSrc}" alt="Uploaded Image" class="uploaded-image" style="width:4rem;height:3rem;object-fit:cover;border-radius:5px;">
                </div>
                <div class="col-7">
                    <h5 class="image-title mb-0">${title}</h5>
                    <div class="d-flex align-items-center mt-1 gap-2">
                    <span class="image-text2 d-block">${response.data.channel_name} 
                    
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="10" viewBox="0 0 24 24" width="10" focusable="false" aria-hidden="true" style=""><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.8 17.3l-4.2-4.1L7 11.8l2.8 2.7L17 7.4l1.4 1.4-8.6 8.5z"></path></svg>
                    </div>
                    <input type="text" class="d-none" value="${title}" name="sug_video_name[]">
                    <input type="text" class="d-none" value="${description}" name="sug_video_description[]">
                    <input type="text" class="d-none" value="${response.data.channel_name}" name="channel_name[]">
                    <input type="text" class="d-none" value="${response.data.channel_avatar}" name="channel_avatar[]">
                    <span class="image-text d-block">42K views</span>
                </div>
            </div>
        `;

        $('.suggestedvideorightside').append(dataO);
        $(".suggestedvideo").append(data);
        $("#suggVideoTitleId").val(''); // Clear the title input
        $("#suggVideoDescId").val('');  // Clear the description input
        $("#inputImage").val('');
        $("#channelNameId").val('');    // Clear the channel name input
        $("#channelAvatarId").val('');  // Clear the channel avatar input
    };

    reader.readAsDataURL(inputimg);

    // Clear error messages
    $("#showSugVideoNameError").text('');
    $("#showSugVideoDescError").text('');
    $("#showSugVideoThumbnailImgError").text('');
    $("#showChannelNameError").text('');
    $("#showChannelAvatarError").text('');
},
        error: function(xhr, status, error) {
            $button.find('.loader').addClass('d-none');
            console.error(xhr.responseText);
        }
    });
});





        });
    </script>


    {{-- Script for savebtn form --}}
    <script>
        $(document).ready(function() {
           // Inicializa SlimSelect apenas para selectedVideo
           const select = new SlimSelect({
                select: '#selectedVideo',
                showSearch: false,
                allowDeselect: true
           });

           // Garante que o templateSelector use o evento change nativo
           document.getElementById('templateSelector').classList.remove('ss-select');
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

$('#suggVideoTitleId').on('input', function() {
    var text = $(this).val();
    var alphanumericCount = enforceLimit2(text);
    $('#suggestedTitle').text(alphanumericCount + '/100');
});

        $(document).on('click', ".dellbtn", function() {
    // Get the ID stored in the parent element (this assumes each image container has a unique boxidstore attribute)
    let mythumbiddell = $(this).closest('.parentSecImg').attr('boxidstore');

    // Remove the associated thumbnail input element
    $(".thumbnailimginput[mythumbid='" + mythumbiddell + "']").remove();

    // Remove the parent image container
    $(this).closest('.parentSecImg').remove();

    // Remove the associated `dataO` content in the suggested video section
    $(`.suggestedvideorightside .parentSecImg[boxidstore='${mythumbiddell}']`).remove();
});

            $(document).on('click', '.deleteRecord', function() {
                var parentDiv = $('.suggestedvideo');
                var deleteImage = parentDiv.find('.col-5');
                var deleteDetails = parentDiv.find('.col-6');
                var deleteDots = parentDiv.find('.col-1');
                deleteImage.css("display", "none");
                deleteDetails.css("display", "none");
                deleteDots.css("display", "none");
            });

            $("#saveBtn, #youtubeSaveBtn").on('click', function() {
                const selectedTemplate = $('#templateSelector').val();
                const translations = {
                    'thumbnail_image_error': "{{ __('dashboard.thumbnail_image_error') }}",
                    'video_name_required': "{{ __('dashboard.video_name_required') }}",
                    'video_name_length': "{{ __('dashboard.video_name_length') }}",
                    'video_description_required': "{{ __('dashboard.video_description_required') }}",
                    'video_shortcode_required': "{{ __('dashboard.video_shortcode_required') }}",
                    'max_value_required': "{{ __('dashboard.max_value_required') }}",
                    'min_value_required': "{{ __('dashboard.min_value_required') }}",
                    'channel_name_required': "{{ __('dashboard.channel_name_required') }}",
                    'channel_avatar_required': "{{ __('dashboard.channel_avatar_required') }}"
                };

                let nameValue = $("#videoNameId").val();
                let descriptionValue = $("#videoDescriptionId").val();
                let shortCodeValue = $("#videoShortCodeId").val();
                let maxNumValue = $("#numMaxId").val();
                let minNumValue = $("#numMinId").val();
                let hasErrors = false;

                // Limpa todas as mensagens de erro
                $("#showVideoNameError, #showVideoDescError, #showVideoShortCodeError, #showVideoMaxNumValueError, #showVideoMinNumValueError").text('');
                $("#showSugVideoNameError, #showSugVideoDescError, #showSugVideoThumbnailImgError, #showChannelNameError, #showChannelAvatarError").text('');

                // Validação dos campos principais
                if (nameValue.length < 1) {
                    $("#showVideoNameError").text(translations.video_name_required);
                    hasErrors = true;
                } else if (nameValue.length < 2 || nameValue.length > 100) {
                    $("#showVideoNameError").text(translations.video_name_length);
                    hasErrors = true;
                }

                if (descriptionValue.length < 1) {
                    $("#showVideoDescError").text(translations.video_description_required);
                    hasErrors = true;
                }

                if (shortCodeValue.length < 1) {
                    $("#showVideoShortCodeError").text(translations.video_shortcode_required);
                    hasErrors = true;
                }

                if (maxNumValue.length < 1) {
                    $("#showVideoMaxNumValueError").text(translations.max_value_required);
                    hasErrors = true;
                }

                if (minNumValue.length < 1) {
                    $("#showVideoMinNumValueError").text(translations.min_value_required);
                    hasErrors = true;
                }

                // Validação dos campos de vídeos sugeridos apenas se o template for YouTube
                if (selectedTemplate === 'youtube' && $(".thumbnailimginput").length == 0) {
                    $("#showSugVideoNameError").text(translations.video_name_length);
                    $("#showSugVideoDescError").text(translations.video_description_required);
                    $("#showSugVideoThumbnailImgError").text(translations.thumbnail_image_error);
                    $("#showChannelNameError").text(translations.channel_name_required);
                    $("#showChannelAvatarError").text(translations.channel_avatar_required);
                    hasErrors = true;
                }

                if (!hasErrors) {
                    // Se for Instagram, adiciona um input hidden com array vazio para imgdata
                    if (selectedTemplate === 'instagram') {
                        // Remove qualquer imgdata existente para evitar duplicatas
                        $('.imagedataclass').empty();
                        // Adiciona um input hidden com array vazio
                        $('.imagedataclass').append('<input type="hidden" name="imgdata[]" value="">');
                        // Atualiza o valor do template no input hidden
                        $('#selectedTemplateInput').val('instagram');
                    } else {
                        // Se for YouTube, atualiza o valor do template
                        $('#selectedTemplateInput').val('youtube');
                    }
                    document.getElementById("formId").submit();
                }
            });

            // $("#suggVideoTitleId").val('');
            //     $("#suggVideoDescId").val('');




        });
    </script>

    {{-- Script for logs --}}
    <script>
        function writeToLog(message) {
            fetch('/write-debug-log', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });
        }

        $(document).ready(function() {
            writeToLog('Página carregada');

            function updateVideo(shortCode) {
                let selectedTemplate = $("#templateSelector").val();
                
                if (selectedTemplate === 'youtube') {
                    $(".embed-responsive-16by9").html(shortCode);
                } else {
                    let container = $("#instagram-video-container");
                    
                    if (container.length > 0) {
                        container.html(''); // Limpa o container
                        container.html(shortCode); // Insere o novo código
                        
                        // Se o código contém um script, executa-o
                        if (shortCode.includes('<script')) {
                            // Remove scripts antigos
                            $('script[id^="scr_"]').remove();
                            
                            // Executa o novo script
                            setTimeout(function() {
                                try {
                                    eval(shortCode);
                                } catch (error) {
                                    console.error('Erro ao executar script:', error);
                                }
                            }, 100);
                        }
                    }
                }
            }

            // Quando o template é alterado
            $("#templateSelector").on('change', function() {
                let shortCode = $("#videoShortCodeId").val();
                if (shortCode) {
                    updateVideo(shortCode);
                }
            });

            // Quando o botão upload é clicado
            $("#uploadBtn").click(function(event) {
                let nameValue = $("#videoNameId").val();
                let descriptionValue = $("#videoDescriptionId").val();
                let shortCodeValue = $("#videoShortCodeId").val();
                let maxNumValue = $("#numMaxId").val();

                if (nameValue.length < 1) {
                    $("#showVideoNameError").text("{{ __('dashboard.video_name_required') }}");
                }
                if (nameValue.length < 2 || nameValue.length > 100) {
                    $("#showVideoNameError").text("{{ __('dashboard.video_name_length') }}");
                }
                if (descriptionValue.length < 1) {
                    $("#showVideoDescError").text("{{ __('dashboard.video_description_required') }}");
                }
                if (shortCodeValue.length < 1) {
                    $("#showVideoShortCodeError").text("{{ __('dashboard.video_shortcode_required') }}");
                }
                if (maxNumValue.length < 1) {
                    $("#showVideoMaxNumValueError").text("{{ __('dashboard.max_value_required') }}");
                }

                if (nameValue && descriptionValue && shortCodeValue) {
                    $("#showName").text(nameValue);
                    $("#showDescription").text(descriptionValue);
                    updateVideo(shortCodeValue);
                    $("#showMaxNumValue").text(maxNumValue);
                }
            });
        });
    </script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> --}}




    <!--  container fluid start here -->
@endsection
