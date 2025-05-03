@props([
    'videoTitle' => 'VEJA COMO FUNCIONA A PLATAFORMA',
    'videoDescription' => '',
    'channelName' => '',
    'viewCount' => '18,533 watching now',
    'shortCode' => '_W9R2czlRtE'
])

<div class="card mt-2 border-0 p-3 shadow-lg" id="youtube-preview-template">
    {{-- Nested row1 start here --}}
    <div class="row video-top-bar px-1 px-lg-0">
        <div class="col-3 p-0">
            <i class="fa-solid fa-bars"></i>
            <i class="fa-brands fa-youtube ms-2" style="color: red"></i>
            <strong class="text-dark youtube-heading" style="font-size:0.8rem">{{ __('dashboard.youtube') }}</strong>
        </div>
        <div class="col-6">
            <div class="input-group">
                <input type="text" class="form-control py-0 px-1 bg-white border-end-0" disabled>
                <span class="input-group-text bg-white p-0 px-2">X</span>
                <span class="input-group-text bg-white" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <span class="input-group-text ms-2 px-2 rounded-pill bg-light">
                    <i class="fa-solid fa-microphone"></i>
                </span>
            </div>
        </div>
        <div class="col-3 text-end gap-2">
            <i class="fa-solid fa-plus"></i>
            <i class="fa-solid fa-bell mx-lg-2 mx-0"></i>
            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid" style="height: 1.3rem">
        </div>
    </div>

    {{-- Nested row2 start here --}}
    <div class="row mt-4 gap-0">
        <div class="col-12 col-lg-8 sugg-container">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe id="showShortCodeLink" class="rounded-2" width="100%" style="height:19.4rem"
                    src="https://www.youtube.com/embed/{{ $shortCode }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>

            {{-- Video title --}}
            <div class="row mt-2">
                <div class="col-12">
                    <h6 class="video-title" id="showName">{{ $videoTitle }}</h6>
                </div>
            </div>

            {{-- Channel info and buttons --}}
            <div class="row mt-2 space-between like-share-btns">
                <div class="col-4 p-0 position-relative">
                    <div style="padding-left:12px" class="d-flex align-items-center gap-2">
                        <div class="">
                            <img src="{{ auth()->user()->profile_picture_path ? asset('storage/' . auth()->user()->profile_picture_path) : asset('storage/profile_picture/placeholder-image.jpg') }}" 
                                class="img-fluid rounded-full"
                                style="height:2.5rem;width:2.5rem;object-fit: cover">
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center gap-2">
                                <span class="channel_name">{{ $channelName }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 0 24 24" width="15" focusable="false"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.8 17.3l-4.2-4.1L7 11.8l2.8 2.7L17 7.4l1.4 1.4-8.6 8.5z"></path></svg>
                            </div>
                            <span class="channel_subs">{{ $viewCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-2 justify-content-start p-0">
                    <button type="button" class="btn py-0 bg-dark text-white subscribe-btn rounded-pill" style="font-size: 0.375rem">
                        {{ __('dashboard.subscribe') }}
                    </button>
                </div>

                <div class="col-6 px-lg-0 px-2 text-xl-center text-end text-lg-start">
                    <a class="btn rounded-pill px-1 million-btn" style="font-size: 0.4rem">
                        <i class="fa-solid fa-thumbs-up"></i> 2.7M 
                        <i class="fa-solid border-start border-2 ps-2 fa-thumbs-down"></i>
                    </a>
                    <a class="btn rounded-pill">
                        <i class="fa-regular fa-share-from-square"></i> {{ __('dashboard.share') }}
                    </a>
                    <a class="btn rounded-pill">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
                </div>
            </div>

            {{-- Video description --}}
            <div class="alert video-description py-1 mt-1">
                <span id="showMaxNumValue" class="d-block showMaxNumValue" style="color:#0F0F0F;font-size:0.6rem">
                    {{ $viewCount }}
                </span>
                <span id="showDescription" class="d-block" style="color:#0F0F0F;font-size:0.6rem">
                    @if($videoDescription)
                        {{ $videoDescription }}
                    @else
                        watching now<br>Started streaming on on 12 Jan 2025 | Lofi Girl - Radios<br> | Listen on Spotify, Apple music and more
                    @endif
                </span>
                <span class="d-block" style="color:#0F0F0F;font-size:0.5rem">
                    <i class="fa-solid fa-arrow-right"></i>
                    <a>https://www.liveturb.com</a>
                </span>
                <span class="d-block" style="color:#0F0F0F;font-size:0.6rem">
                    ... more
                </span>
            </div>
        </div>

        <div class="col-lg-4 col-lg-4 px-0 pe-2 px-md-3 px-lg-0 sugg-container">
            {{-- Top chat card start here --}}
            <div class="card" style="border-radius: 0.5rem">
                <div class="top-chat-area border-1 px-1 border-bottom">
                    <button class="btn border-0" style="font-size:0.5rem">{{ __('dashboard.top_chat') }} <i class="fa-solid fa-check"></i></button>
                    <span class="float-end">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                        &nbsp;
                        <i class="fa-solid fa-xmark pe-1"></i>
                    </span>
                </div>

                {{-- Live comments section start here --}}
                <div class="live-comments mt-0">
                    {{-- Row for live comments start here --}}
                    <div class="row px-2 gap-0">
                        {{-- Comentário 1 --}}
                        <div class="col-3">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>To Adorando essa live Pra cima 🔥🔥</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 2 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Wow! This live is amazing, I'm loving it! 🎉</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 3 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Can't wait to place my order. Great content!</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 4 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>This product looks fantastic, I'm in!</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 5 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Best live I've watched today. Great job! 👏</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 6 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Mais alguem assistindo ??</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 7 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Perfect timing for this! I'm so excited. ✨</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 8 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Great explanations, really helpful.</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 9 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Conteudo Topp 🚀🚀🚀</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 10 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Absolutely love this product! Can't wait to buy.</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 11 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>This live stream is so informative, thank you!🔥🔥</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Comentário 12 --}}
                        <div class="col-3 mt-1">
                            <img src="{{ asset('storage/mybroadcasts/youtube-person.png') }}" class="img-fluid">
                        </div>
                        <div class="col-9 ps-1 mt-1">
                            <div class="row">
                                <div class="col-9 p-0">
                                    <span>Cade o botao de Compra quero Comprar!!💲💲</span>
                                </div>
                                <div class="col-3 p-0">
                                    <button class="btn p-0 opacity-50 pe-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn p-0 opacity-50 me-1" style="font-size: 0.6rem">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Row for live comments end here --}}
                </div>
                {{-- Live comments section end here --}}
                <div class="alert m-0 p-0 mt-0 rounded-0 mb-0 pb-1 border-top">
                    <i class="fa-solid fa-info pb-2 rounded-0 px-2 py-1 rounded-circle d-inline"></i>
                    <span class="d-inline" style="color:#424242; font-size:0.7rem">{{ __('dashboard.subscribers_only_mode') }}</span>
                </div>
            </div>
            {{-- Top chat card end here --}}

            {{-- short videos section start here --}}
            <div class="short-videos mt-2 px-0 ms-1">
                <button type="button" class="btn px-1 bg-dark py-0 text-white">{{ __('dashboard.all') }}</button>
                <button type="button" class="btn px-1 py-0">{{ __('dashboard.from_your_search') }}</button>
                <button type="button" class="btn px-1 py-0">{{ __('dashboard.from_lofi_girl') }}</button>
                <button type="button" class="btn px-1 py-0">{{ __('dashboard.lo_fl') }}</button>

                {{-- Nested Row start here --}}
                <div class="row mt-2 g-2 suggestedvideorightside">
                    {{-- Os vídeos sugeridos serão inseridos aqui dinamicamente via JavaScript --}}
                </div>
            </div>
            {{-- short videos section end here --}}
        </div>
    </div>
</div>
