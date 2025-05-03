<div class="modal fade" id="modal-{{ $videoThumbnail->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel-{{ $videoThumbnail->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{ __('dashboard.update') }}</h5>
          <button type="button" class="btn-close" id="modal-close-btn-{{$videoThumbnail->id }}" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="file" class="d-none thumb-image" id="inputImage-{{ $videoThumbnail->id }}">

          <label for="inputImage-{{ $videoThumbnail->id }}" class="btn form-control w-100 shadow py-2 text-center thumbnail-btn">
              {{ __('dashboard.update_thumbnail') }}
              <img src="{{ asset('storage/mybroadcasts/thumbnail.png') }}" class="h-75 mx-1">
          </label>


          <p id="showSugVideoThumbnailImgError" class="ms-2 ps-1 mt-2"
              style="color:red;font-size:0.8rem;"></p>

          <input type="hidden" class="thumb-id" value="{{$videoThumbnail->id}}">
          <h3 class="box-title m-2 mt-3">{{ __('dashboard.video_title') }}</h3>
          <div class="div box-div m-2 border  py-2 px-3 ">
              <h6 class="box-div-title">{{ __('dashboard.title_required') }}</h6>
              <textarea id="suggVideoTitleId" class="form-control card-text text-area-scroll-bar border-0 p-0 pt-1 thumb-title"
                  placeholder="{{ __('dashboard.enter_video_name') }}" style="resize:none;height:0.5rem">{{ $videoThumbnail->title ? $videoThumbnail->title : '' }}</textarea>
              
          </div>
          <p id="showSugVideoNameError" class="ms-2 ps-1 mt-0"
              style="color:red;font-size:0.8rem;">
          </p>


          <h3 class="box-title ms-2 mt-4">{{ __('dashboard.video_description') }}</h3>
          <div class="div box-div m-2 border  py-2 pb-4 px-3 ">
              <h6 class="box-div-title">{{ __('dashboard.details_required') }}</h6>
              <textarea id="suggVideoDescId" class="form-control card-text border-0 p-0 pt-1 text-area-scroll-bar thumb-description"
                  placeholder="{{ __('dashboard.enter_video_description') }}" style="resize:none;">{{ $videoThumbnail->description ? $videoThumbnail->description : '' }}</textarea>

          </div>
          <p id="showSugVideoDescError" class="ms-2 ps-1 mt-0"
              style="color:red;font-size:0.8rem;">
          </p>
          
          
           <h3 class="box-title ms-2 mt-4">{{ __('dashboard.channel_name') }}</h3>
    <div class="div box-div m-2 border py-2 pb-4 px-3">
        <h6 class="box-div-title">{{ __('dashboard.channel_name_required') }}</h6>
        <input type="text" id="channelName-{{ $videoThumbnail->id }}" class="form-control card-text border-0 p-0 pt-1 thumb-channel-name"
            placeholder="{{ __('dashboard.enter_channel_name') }}" value="{{ $videoThumbnail->channel_name ? $videoThumbnail->channel_name : '' }}" />
    </div>
    <p id="showChannelNameError" class="ms-2 ps-1 mt-0" style="color:red;font-size:0.8rem;"></p>

    <h3 class="box-title ms-2 mt-4">{{ __('dashboard.channel_avatar') }}</h3>
    <div class="div box-div m-2 border py-2 pb-4 px-3">
        <h6 class="box-div-title">{{ __('dashboard.channel_avatar_required') }}</h6>
        <input type="file" class="form-control thumb-avatar" id="channelAvatar-{{ $videoThumbnail->id }}">
    </div>
    <p id="showChannelAvatarError" class="ms-2 ps-1 mt-0" style="color:red;font-size:0.8rem;"></p>


          <button type="button" id="addBtnClick"
              class="btn thumbnail-btn float-end rounded-3 py-1 px-2 text-white update-btn"
              style="cursor: pointer">{{ __('dashboard.update') }}
          </button>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
  </div>
  <script>
    
  </script>