<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}" />
    @vite('resources/sass/app.scss')

    <!-- font awesom cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('storage/css/customstyle.css') }}" />
    <link rel="stylesheet" href="{{ asset('storage/css/profile-management.css') }}" />
    <link rel="stylesheet" href="{{ asset('storage/css/comment-management.css') }}" />
    <link rel="stylesheet" href="{{ asset('storage/css/my-broadcasts.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
        integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"
        integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    dl,
    ol,
    ul {
        margin-top: 0;
        margin-bottom: 0rem;
    }

    ol,
    ul {
        padding-left: 0rem;
    }
    .video-title{
        color:#000000;
    font-size: 20px;
    line-height: 1.8rem;
    font-weight: 700;
    overflow: hidden;
    display: block;
    max-height: 5.6rem;
    -webkit-line-clamp: 2;
    display: box;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal;
    }

    .comment-avatar {
        height: 28px;
        width: 28px;
        object-fit: cover;
        border-radius: 30px;
    }
    .live-comments{
        height: 25rem;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .youtube-btn2{
        background-color: rgba(0,0,0,0.05);
        border: 0;
        transition:all 0.3s ease-in-out;

    } 
        .embed-responsive{
            width:100%;
        }
        iframe{
            width:100% !important;
            height:100% !important;
        }

      .youtube-btn2:hover{
        background-color: rgba(0,0,0,0.1);

    }
    .video-description {
    background-color: #F2F2F2;
}
.video-comment-container{
    display:none;
}
.my-comment{
        background: #efefef !important;
}
.numbx-count{
    display:none;
}
.btn-chat{
        color: #0f0f0f;
    border-color: rgba(0, 0, 0, 0.1);
    padding: 0 15px;
    border-width: 1px;
    border-style: solid;
        height: 36px;
    font-size: 14px;
    line-height: 36px;
    border-radius: 18px;
    width:100%;
    font-weight:500;
    background:transparent;
    display:none;
}
.btn-chat:hover {
    background: rgba(0, 0, 0, 0.1);
}
.close-icon{
    cursor:pointer;
}
.comment-render {
    display: flex;
    align-items: flex-start;
    margin-bottom: 0px; 
    padding: 10px;
    background-color: #fff; 
    height: auto; 
    overflow: visible; 
    word-wrap: break-word; 
    clear: both;
}

.comment-avatar2 {
    width: 29px;
    height: 29px;
    display: flex;
    font-size: 16px;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #fff;
    font-weight: 500;
    margin-right: 0px; 
}

.live-comments {
    overflow-y: auto; 

}

.mg1{
    border-top-left-radius:50rem;
    border-bottom-left-radius:50rem;
    display:flex;
    gap:6px;
     position:relative;
    align-items:center;
    margin-right:0 !important;
 
}
.mg2{
    position:relative;
    border-top-right-radius:50rem;
    border-bottom-right-radius:50rem;
    margin-right:0 !important;
    
}
.mg1:after{
    content: "";
    background: rgba(0, 0, 0, 0.1);
    position: absolute;
    right: 0;
    top: 6px;
    height: 24px;
    width: 1px;
}
.btn-text{
        font-size: 0.9rem;
        font-weight:500;
        color:#0f0f0f;
    /*        text-overflow: ellipsis;*/
    /*overflow: hidden;*/
}
.mg3{

    display:flex;
    gap:6px;
    align-items:center;
}
.ytbtn-container{
    display:flex;
    align-items:center;
    gap:10px
}
.py-15 {
    padding-top: .3rem !important;
    padding-bottom: .3rem !important;
}
.subscribe-btn{
   color: #fff;
    background: #0f0f0f;
    padding: 0 16px;
    height: 36px;
    font-size: 14px;
    line-height:0;
    border:0;
    border-radius: 18px;
}
.channel_name{
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 1rem;
    color: #000000;
    font-weight:500;
}
.channel_subs{
        color: #606060;
    margin-right: 4px;

    font-size: 0.8rem;
  
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
  .lgcontainer{
          display:block;
      }
      .smcontainer{
          display:none;
      }
        #mob-tab-title{
         display:none;
     }
     .engagement-panel-drag-line {
    background: #0f0f0f;
    opacity: .15;
    border-radius: 4px;
    height: 4px;
    margin: 0 auto;
    width: 40px;
    display:none;
}
#closeIconSm{
    display:none;
}

.dd-whitsr{
    margin-right:10px;
        transition: background-color 0.3s ease;
                padding: 6px 17px;
        border-radius: 8px;
        font-size:12px;
}
.dd-whitsr:hover {
    background-color: #ddd;
}

.dd-whitsr.bg-dark {
    background-color: #333;
        
}
.short-videos .button-container::-webkit-scrollbar {
    display: none; 
}
.numbx-count{
    display:none;
}
#smartplayer{
    border-radius:15px !important;
}
.top-chat-area{
    padding:4px 0;
}
.mh-213{
    flex:1;
}
.yt-drp-btn{
    background:transparent;
        min-width: 0;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    padding: 0;
    border-color: transparent;
    transition:none;
}
.yt-drp-btn:hover{
        background: rgba(0, 0, 0, 0.1);
    
}
.yt-drp-btn2{
    background:transparent;
        min-width: 0;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    padding: 0;
    border-color: transparent;
    transition:none;
}
.yt-drp-btn2:hover{
        background: rgba(0, 0, 0, 0.1);
    
}
.drop-button{
    font-size:16px !important;
        white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #0f0f0f;
        padding: 0px 0px 0 10px;
}

.yt-svg{
    
}
.turb-logo{
    width:2.5rem;
}
.yt-searchbox{
        position: relative;
  
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-right: none;
    border-radius: 40px 0 0 40px;
    box-shadow: inset 0 1px 2px #eee;
    caret-color: #0f0f0f;
    color: #111111;
    padding: 0 4px 0 16px !important;
    margin-left: 32px;
}
.searchbox-group{
     background-color: #ffffff;
       border: 1px solid #ccc;
    border-right: none;
    border-radius: 40px 0 0 40px;
    box-shadow: inset 0 1px 2px #eee;
}
.searchbox-button{
        border: 1px solid #d3d3d3;
    background-color: #f8f8f8;
    border-radius: 0 40px 40px 0;
    cursor: pointer;
    height: 40px;
    width: 56px;
    margin: 0;
}
.searchbox-mic{
        min-width: 0;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    padding: 0;
    background:#F2F2F2;
    border:0;
}
.header-container{
    position:relative;
    z-index:40000;
    background:#ffffff;
}
.mob-search-icon{
    display:none !important;
}
    .short-videos .button-container {
        white-space: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

@media screen and (max-width: 767px) {
    .short-videos .button-container {
    white-space: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.comment-avatar2 {
    width: 30px;
    height: 30px;
    font-size:16px;
    font-weight:700;
}
.user-avatar2{
        width: 30px;
    height: 30px;
    font-size:16px;
    font-weight:700;
}
.comment-render span{
        font-size: 12px !important;
}
#smartplayer{
    border-radius:0 !important;
}
.mv-asde{
    display:none !important;
}
.numbx-count{
 display:block;    
}

.live-comments{
    height:auto;
}


    .dd-whitsr {
        flex-shrink: 0;
        margin-right: 8px;
        background-color: #f1f1f1;
        padding: 6px 17px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 14px;

    }



       .f-container{
          padding:0 !important;
       }
       .f-container2{
          padding:0 !important;
       }
       .thbm{
           align-items:center;
       }
       .gv-row{
           padding:0 !important;
       }
       .gv-child-row{
           width:100%;
           padding:0 15px;
       }
       .like-share-btns{
           padding:0 15px;
           margin-bottom:15px;
       }
       .gv-flow{
           justify-content:space-between;
           width:100%;
           margin-bottom:15px;
       }
       .alert-container{
           padding:0 15px;
       }
       .chatbox-container{
           display:none;
       }
       .button-of-showchat{
           display:none;
       }
       .f-container2{
           width:100%;
       }
       img.uploaded-image{
           height:14rem !important;
           border-radius:0 !important;
       }
      .card-body{
              padding: 1rem 0.7rem;
      }
      .lgcontainer{
          display:none;
      }
      .smcontainer{
          display:block;
      }
      
      .commentL{
          background-color: #f3f3f3 !important;
      }
      .
      .smcontainer{
          display:block !important;
      }
      .views-wrap{
          display:none !important;
      }
      .image-title{
       font-size:0.9rem !important;
       font-weight:600 !important;
       margin-bottom:3px;
      }
      .sm-container-wrapper{
          width:100%;
      }
      .image-text2{
          font-size:0.7rem;
          max-width:100px;
      }
      .pp-container{
          flex:1;
      }
      .video-comment-container{
          padding:13px;
          display:block;
          background:rgba(0,0,0,0.05);
          border-radius:16px;
      }
          .sm-open-comment {
        border-radius: 56px;
        background: rgb(0 0 0 / 6%);
        width: 83%;
        padding: 3px 10px;
    }
.video-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%; 
    height: 50%; 
    z-index: 1000;
    transition: all 0.3s ease;
}

.chatbox-container {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%; 
    background-color: white; 
    z-index: 1001;
    display:none;
    overflow-y: auto; 
    padding-top: 55%;
}

.top-chat-area {
    position: fixed;
    /* top: 29%; */
    width: 100%;
    background: white;
    z-index: 50000;
    height: 5.4rem;
    padding: 4% 0 5% 0;
}    
#alert-fg{
    position:fixed;
    width:100%;
    background:white;
    z-index:60000;
            bottom: 0;
}
     #mob-tab-title{
         margin-bottom: 0px !important;
        display: block;
        margin-left: 12px;
        font-size:18px !important;
        margin-top: 8px;
     }
     .short-videos{
         padding:0 13px !important;
     }
     .live-comments{
         padding-top: 70px;
         padding-bottom:50px;
         
         
     }
     /*.top-chat-area{*/
     /* position:relative;*/
         
     /*}*/
     #closeIconSm {
         display:block;
 
}
.yt-drp-btn{
               position: absolute;
        right: 13px;
        bottom: 10px;
            display: flex;
    justify-content: center;
    align-items: center;
    }

.yt-drp-btn2{
     position: absolute;
        right: 50px;
        bottom: 10px;
            display: flex;
    justify-content: center;
    align-items: center;
}
.engagement-panel-drag-line{
    display:block;
    position: relative;
    top:11px;
    
}
.drop-button{
        font-size: 13px !important;
    padding: 0px 0px 0 12px;
}

.search-ses{
    display:none;
}
.header-avatar-container{
    display:none;
}

.mob-search-icon{
    display:block !important;
}
.search-sce{
        width: 58.33333333%;
            margin: 0 0 0 auto !important;
}
.turb-logo {
    width: 2.5rem;
}
.header-container{
    display:none;
}
    .embed-responsive{
            width:100%;
        }

}

@media screen and (max-width: 767px) {
  .row.video-top-bar.px-1.px-lg-0 {
    display: none;
  }
}


@media (min-width: 992px) {
    .py-lg-1 {
        padding-top: 0.85rem !important;
        padding-bottom: 1.25rem !important;
    }
}

@media (min-width: 1400px) {
    .gv-container {
        max-width: 190vh !important;
    }
    .gv-child-row.mt-3 {
        margin-top: 1% !important;
    }
    .like-share-btns.justify-content-between {
        justify-content: space-between !important;
        padding: 10px;
    }
    .live-comments {
        overflow-y: auto;
        height: 62vh !important;
    }
    .row.mt-lg-4 {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0.5rem;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-5.5 * var(--bs-gutter-x));
        margin-left: calc(-.5 * var(--bs-gutter-x));
    }
}
.comment-render span[style*="font-weight: 500; color: hsl(0deg 0% 0% / 60%)"] {
    font-size: 13px !important;
}
.uploaded-image {
    width: 100%;
    height: 8.5rem;
    object-fit: cover;
    border-radius: 8px;
}
.btn-chat:hover {
    background: rgba(0, 0, 0, 0.1);
    border-color: transparent;
}
#showMaxNumValue {
    font-weight:700;
    transition: all 0.5s ease;
}
.image-title {
        font-size: 1.0rem !important;
    font-weight: 700;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-word;
    overflow-wrap: break-word;
    word-wrap: break-word;
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
    color:#606060;
}
.add-comment-input{
    background:rgba(0,0,0,0.05);
    border-radius:18px;
        padding: 0.2rem .75rem;
}
.user-avatar-container{
    display:none;
}
.send-comment-container{
    display:none;
}
.user-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    font-size: 21px;
    font-weight: bold;
    color: #fff;
    border-radius: 50%;
    background-color: #356f3f;
}
.user-avatar2 {
    display: flex;
    align-items: center;
    justify-content: center;
   width: 24px;
    height: 24px;

    font-size: 12px;

    font-weight: 500;
    color: #fff;
    border-radius: 50%;
    margin-right:0px;
    background-color: #356f3f;
}
.user-avatar3 {
    display: flex;
    align-items: center;
    justify-content: center;
   width: 32px;
    height: 32px;

    font-size: 17px;

    font-weight: 500;
    color: #fff;
    border-radius: 50%;
    margin-right:10px;
    background-color: #356f3f;
}
.comment-avatar2 {
    width: 29px;
    height: 29px;
    display: flex;
    font-size: 16px;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #fff;
    font-weight: 500;
    margin-right: 0px;
}
.send-btn-comment{
    width: 34px;
    border-radius: 20px;
    height: 35px;
    border:0;
    transition:all 0.3s ease-in-out;
    background: transparent;
    
}
.send-btn-comment:hover{
        background: rgba(0, 0, 0, 0.1);
}
</style>

<body style="font-family: inter" class="bg-white">
    <div class="row video-top-bar px-1 px-lg-0">
        <div class="col-3 px-3">
            <div class="d-flex align-items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="yt-svg" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path d="M21 6H3V5h18v1zm0 5H3v1h18v-1zm0 6H3v1h18v-1z"></path></svg>
              <img src="{{ asset('storage/mybroadcasts/liveturb.png') }}"  class="img-fluid turb-logo" style="">
                </div>

        </div>
    
        <div class="col-5 search-ses">
            <div class="input-group ">
                <input type="text" placeholder="Search" class="form-control py-0 px-1  bg-white border-end-0 yt-searchbox" disabled
                    aria-label="Dollar amount (with dot and two decimal places)">
                <!--<span class="input-group-text p-0 px-2 searchbox-group">-->
                    
                    <!--<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path d="M14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2zm3-7H3v12h14v-6.39l4 1.83V8.56l-4 1.83V6m1-1v3.83L22 7v8l-4-1.83V19H2V5h16z"></path></svg>-->
                <!--</span>-->
    
                <span class="input-group-text searchbox-button"
                    style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path clip-rule="evenodd" d="M16.296 16.996a8 8 0 11.707-.708l3.909 3.91-.707.707-3.909-3.909zM18 11a7 7 0 00-14 0 7 7 0 1014 0z" fill-rule="evenodd"></path></svg></span>
    
                <span class="input-group-text ms-2 px-2  rounded-pill searchbox-mic">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path d="M12 3c-1.66 0-3 1.37-3 3.07v5.86c0 1.7 1.34 3.07 3 3.07s3-1.37 3-3.07V6.07C15 4.37 13.66 3 12 3zm6.5 9h-1c0 3.03-2.47 5.5-5.5 5.5S6.5 15.03 6.5 12h-1c0 3.24 2.39 5.93 5.5 6.41V21h2v-2.59c3.11-.48 5.5-3.17 5.5-6.41z"></path></svg>
                </span>
            </div>
        </div>
    
        <div class="col-4 text-end gap-2 m-auto search-sce">
            <div class="d-flex align-item-center gap-4 m-auto justify-content-end">
                           <svg xmlns="http://www.w3.org/2000/svg" class="mv-asde" height="24" style="pointer-events: none; display: inherit;" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true"><path d="M14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2zm3-7H3v12h14v-6.39l4 1.83V8.56l-4 1.83V6m1-1v3.83L22 7v8l-4-1.83V19H2V5h16z"></path></svg>
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path d="M10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2zm10-2.65V19H4v-1.65l2-1.88v-5.15C6 7.4 7.56 5.1 10 4.34v-.38c0-1.42 1.49-2.5 2.99-1.76.65.32 1.01 1.03 1.01 1.76v.39c2.44.75 4 3.06 4 5.98v5.15l2 1.87zm-1 .42-2-1.88v-5.47c0-2.47-1.19-4.36-3.13-5.1-1.26-.53-2.64-.5-3.84.03C8.15 6.11 7 7.99 7 10.42v5.47l-2 1.88V18h14v-.23z"></path></svg>
            <div class="header-avatar-container">
                             <div class="rounded-full user-avatar3 header-avatar">
                            U
                        </div>
                        </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="mob-search-icon" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path clip-rule="evenodd" d="M16.296 16.996a8 8 0 11.707-.708l3.909 3.91-.707.707-3.909-3.909zM18 11a7 7 0 00-14 0 7 7 0 1014 0z" fill-rule="evenodd"></path></svg>
                
            </div>

        </div>
    </div>
    <div class="container gv-container">
        <div class="p-4 gv-row">
            {{-- Nested  row1 start here --}}
    
            {{-- Nested  row1 end here --}}
    
    
    
            {{-- Nested  row2 start here --}}
            <div class="row mt-lg-4 gap-0 ">
    
                <div class="col-12 col-lg-8 f-container">
                    {{-- <video height="240" controls autoplay muted>
                        <source src="movie.mp4" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                    </video> --}}
                    <div style="position:relative;z-index:4000000" class="embed-responsive embed-responsive-16by9">
                   
                        {!! $video->details_video_shortcode !!}
                    </div>
    
                    {{-- <img src="{{ asset('storage/mybroadcasts/image1.png') }}" class="img-fluid w-100"
                        height="200" /> --}}
    
    
                    {{-- Row for video title start here --}}
                    <div class="row mt-3 gv-child-row">
                        <div class="col-12">
                            <h6 class="video-title" id="showName">{{ $video->details_video_title }}
                            </h6>
                        </div>
                    </div>
                    {{-- Row for video title end here --}}
    
                    {{-- Row for share like buttons start here --}}
                    <div class="d-flex justify-content-between like-share-btns flex-wrap">
                        <div class="d-flex align-items-center gap-3 gv-flow">
                            <div class="d-flex align-items-center gap-2">
                                <div class="">
                                    <img src="{{ $video->user->profile_picture_path ? asset('storage/' . $video->user->profile_picture_path) : asset('storage/profile_picture/placeholder-image.jpg') }}" class="img-fluid rounded-full"
                                        style="height:2.5rem;width:2.5rem;object-fit: cover">
            
                                </div>

                    
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center gap-2">
                                            <span class="channel_name"
                                        style="">{{ $video->user->name }} </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 0 24 24" width="15" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.8 17.3l-4.2-4.1L7 11.8l2.8 2.7L17 7.4l1.4 1.4-8.6 8.5z"></path></svg>
                                    </div>
                                
                                    <span class="channel_subs"
                                        style="">14.2M subscribers </span>
            
                                </div>
                            </div>
                            <div class="justify-content-start p-0">
                                <button class="subscribe-btn"
                                    style="">Subscribe</button>
        
                            </div>
                        </div>
                      
                        
    
                        <div class="ytbtn-container">
                            <div class="btn-group">
                            <button class="youtube-btn2 px-2 py-15 million-btn mg1" style="font-size: 0.9rem">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit; width: 100%; height: 100%;"><path d="M18.77,11h-4.23l1.52-4.94C16.38,5.03,15.54,4,14.38,4c-0.58,0-1.14,0.24-1.52,0.65L7,11H3v10h4h1h9.43 c1.06,0,1.98-0.67,2.19-1.61l1.34-6C21.23,12.15,20.18,11,18.77,11z M7,20H4v-8h3V20z M19.98,13.17l-1.34,6 C18.54,19.65,18.03,20,17.43,20H8v-8.61l5.6-6.06C13.79,5.12,14.08,5,14.38,5c0.26,0,0.5,0.11,0.63,0.3 c0.07,0.1,0.15,0.26,0.09,0.47l-1.52,4.94L13.18,12h1.35h4.23c0.41,0,0.8,0.17,1.03,0.46C19.92,12.61,20.05,12.86,19.98,13.17z"></path></svg>
                                <span class="btn-text">62k</span>
                                
                                </button>
                                  
                                     <button class="youtube-btn2 px-2 py-15 million-btn mg2" style="font-size: 0.9rem">
                                         <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit; width: 100%; height: 100%;"><path d="M17,4h-1H6.57C5.5,4,4.59,4.67,4.38,5.61l-1.34,6C2.77,12.85,3.82,14,5.23,14h4.23l-1.52,4.94C7.62,19.97,8.46,21,9.62,21 c0.58,0,1.14-0.24,1.52-0.65L17,14h4V4H17z M10.4,19.67C10.21,19.88,9.92,20,9.62,20c-0.26,0-0.5-0.11-0.63-0.3 c-0.07-0.1-0.15-0.26-0.09-0.47l1.52-4.94l0.4-1.29H9.46H5.23c-0.41,0-0.8-0.17-1.03-0.46c-0.12-0.15-0.25-0.4-0.18-0.72l1.34-6 C5.46,5.35,5.97,5,6.57,5H16v8.61L10.4,19.67z M16.9739,11H6.80218L5.44596,4.89699L16.9739,11Z"></path></svg>
                                </button>
                            </div>
                            <button class="youtube-btn2 rounded-pill px-2 py-15 mg3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit; width: 100%; height: 100%;"><path d="M15 5.63 20.66 12 15 18.37V14h-1c-3.96 0-7.14 1-9.75 3.09 1.84-4.07 5.11-6.4 9.89-7.1l.86-.13V5.63M14 3v6C6.22 10.13 3.11 15.33 2 21c2.78-3.97 6.44-6 12-6v6l8-9-8-9z"></path></svg>
                                <span class="btn-text">Share</span>
                            </button>
                            <button class="youtube-btn2 rounded-pill px-2 py-15 mg3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit; width: 100%; height: 100%;"><path d="M18 4v15.06l-5.42-3.87-.58-.42-.58.42L6 19.06V4h12m1-1H5v18l7-5 7 5V3z"></path></svg>
                                
                                <span class="btn-text">Save</span>
                                
                                </button>
                            <!--<button class="youtube-btn2 rounded-pill clip-btn px-2 py-1"><i class="fa-regular fa-bookmark"></i>-->
                            <!--    Clip</button>-->
                            <button style="" class="youtube-btn2 rounded-pill px-2 py-15">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit; width: 100%; height: 100%;"><path d="M7.5 12c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5zm4.5-1.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path></svg>
                                
                            </button>
    
    
                        </div>
    
    
    
                    </div>
                    {{-- Row for share like buttons end here --}}
    
                    {{-- video description start here --}}
                    <div class="alert-container">
                          <div class="alert video-description py-3 py-lg-1 mt-1">
                        <span id="showMaxNumValue" class="d-inline" style="color:#0F0F0F;font-size:0.9rem;font-weight:700">{{$video->details_video_minnum}} watching now</span>
                            <span style="color:#0F0F0F;font-size:0.9rem;font-weight:700">•</span>
                            <span style="color:#0F0F0F;font-size:0.9rem;font-weight:700">Broadcast started 1 hour</span>
                   
                        <span id="showDescription" class="d-block" style="color:#0F0F0F;font-size:0.8rem">
                            {{ $video->details_video_description }}


                           
                        </span>
                      
                    </div>  
                    
                    
                      <div class="alert video-comment-container mt-1">
                         <h5  class="image-title mb-3">
                                                    Live chat</h5>
                        <div class="d-flex justify-content-end">
                            <div class="sm-open-comment">
                                  <span class="image-text2 d-block">Say something...</span>
                            </div>
                        </div>                            
                      
                    </div> 
                    </div>
                
                    {{-- video description end here --}}
    
                </div>
    
    
                <div class="col-lg-3 col-lg-3 px-0 pe-2 px-md-3 px-lg-0 f-container">
                    {{-- Top chat card start here --}}
                    <div class="card chatbox-container" style="border-radius: 15px">
                        
                        <div class="top-chat-area border-1  px-1 border-bottom d-lg-flex align-items-center">
                            <div class="engagement-panel-drag-line"></div>
     <h5 id="mob-tab-title" class="image-title mb-3">
                                                    Live chat</h5>
                            <div class="d-flex align-items-center mh-213">
 <div class="d-flex align-items-center mh-213">
    <!-- Botão com Top Message -->
    <button class="btn border-0 drop-button" style="font-size:0.7rem; margin-right: 5px;">
        Top Message
    </button>

    <!-- Ícone SVG -->
    <svg width="13px" height="13px" viewBox="-0.009 0 0.406 0.406" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;">
        <path d="M0.195 0.212a0.074 0.074 0 1 0 0 -0.146 0.074 0.074 0 0 0 0 0.146" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.01625"/>
        <path d="M0.146 0.193H0.145" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.01625"/>
        <path d="M0.276 0.209a0.146 0.146 0 0 1 0.074 0.123 0.008 0.008 0 0 1 -0.009 0.009H0.049A0.008 0.008 0 0 1 0.041 0.331 0.146 0.146 0 0 1 0.114 0.209" stroke="#0F0F0F" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.01625"/>
    </svg>

    <!-- Número com valores -->
    <div class="numbx-count">
        <span id="showMaxNumValueComment" class="d-block" style="color:#212529; font-size:0.9rem;">
            {{$video->details_video_minnum}}
        </span>
    </div>
</div>

                            </div>
                            <span class="">
                                <button class="yt-drp-btn2">
                                     <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit;"><path d="M12 16.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zM10.5 12c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5z"></path></svg>
                                </button>
                               
                            </span>
                                           
                            <span class="">
                                <!--<i  class="fa-solid fa-xmark pe-1 close-icon cursor-pointer d-none d-lg-inline"></i>-->
                                <button class="yt-drp-btn">
                                    <svg id="closeIconLg" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" class="close-icon cursor-pointer d-none d-lg-inline" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style=""><path d="M12.71 12 8.15 8.15-.71.71L12 12.71l8.15-8.15.71.71L12.71 12z"></path></svg>
    <!-- Close icon for small screens -->
    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="" id="closeIconSm">
  <path d="M18.3 5.71a.996.996 0 0 0-1.41 0L12 10.59 7.11 5.7A.996.996 0 1 0 5.7 7.11L10.59 12 5.7 16.89a.996.996 0 1 0 1.41 1.41L12 13.41l4.89 4.89a.996.996 0 1 0 1.41-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" fill="#000000"/>
</svg>
                                </button>
                                
                            </span>
                        </div>
    
                        {{-- Live comments section start here --}}
                        <div class="live-comments mt-0">
    @php
    $authorNames = [
        'John Doe', ',Jane Smith','Brad Castor','Michael Smith', 'Emma Johnson', 'William Davis', 'Sophia Anderson', 
        'James Wilson', 'Isabella Miller', 'Alexander Moore', 'Olivia Brown', 'Daniel Taylor', 'Charlotte Harris', 
        'Matthew Clark', 'Ava Martinez', 'David Thompson', 'Mia Robinson', 'Joseph Wright', 'Emily Turner', 'Benjamin Cooper', 
        'Abigail Parker', 'Christopher Lee', 'Elizabeth Grant', 'Andrew Jackson', 'Sarah Collins', 'John Adams', 
        'Madison Foster', 'Thomas Jefferson', 'Victor Hughes', 'Robert White', 'Grace Williams', 'Richard King', 
        'Sofia Rodriguez','Martim Luter','Eduardo Silva','Jane Smith', 'Alex Johnson', 'Chris Lee', 'Patricia Brown', 'Michael Davis',
        'Jessica Garcia', 'Matthew Martinez', 'Emma Williams', 'Liam O Connor', 'Oliver Chen', 'Noah Muller',
        'Sophia Rossi', 'Lucas Oliveira', 'Isabella Fernández', 'Ethan Patel', 'Mia Kowalski', 'Benjamin Silva',
        'Ava Nguyen', 'James Wilson', 'Emily Kim', 'William Thompson', 'Amelia Dubois', 'Henry Clark',
        'Charles López', 'Alexander Schmidt', 'Grace Adams', 'Samuel Brown', 'Avery Anderson', 'Daniela Singh',
        'Sofia Hernandez', 'Emily Ivanov', 'Leonard Harris', 'Jack Robinson', 'Chloe Martin', 'Michael Taylor',
        'Harper Evans', 'Thomas White', 'Evelyn Clark', 'Jack Campbell', 'Scarlett Lewis', 'Sebastian Wright',
        'Zoe Phillips', 'Mason Kim', 'Abigail Mitchell', 'Logan Cooper', 'Lily Green', 'Elijah Baker',
        'Hannah Carter', 'Jac Rivera', 'Emily Edwards', 'Owen Hughes', 'Ella Russell', 'Gabriella Kelly',
        'Aria Ward', 'Aiden Parker', 'Victor Hughes', 'Isaac Jenkins', 'Maya Flores', 'Joshua Morales',
        'Ezra Ward', 'Anthony Cox', 'Charles Richardson', 'Nicholas Bennett', 'Julian Brooks', 'Grayson James', 
        'Adam Long', 'Christopher Wood', 'Adrian Hill', 'Jonathan Reynolds', 'Miles Bailey', 'Evan Hughes', 
        'Dominic Gonzalez', 'Connor Butler', 'Cole Sanders', 'Parker Morris', 'Roman Myers', 'Hudson Ross', 
        'Gavin Sullivan', 'Brandon Gutierrez', 'Kevin Ramos', 'Leo Jenkins', 'Landon Perry', 'Jason Bryant', 
        'Eric Spencer', 'Zachary West', 'Austin Hunt', 'Elliot Porter', 'Bryson Castillo', 'Justin Cunningham', 
        'Camden Wells', 'Xavier Arnold', 'Bentley Gilbert', 'Carson Mendoza', 'Maxwell Oliver', 'Sawyer Lowe', 
        'Luca Fowler', 'Calvin Drake', 'Tyler Greene', 'Asher Hamilton', 'Finn Coleman', 'Nolan Pearson', 
        'Easton Fletcher', 'Marcus Hoffman', 'Victor Ford', 'Elias Peters', 'Alex Berry', 'Theo Holt', 
        'Jake Wallace', 'Oscar Weaver', 'Blake Rice', 'Damian Hart', 'Chase Stone', 'Max Reid', 'Colton Gibson', 
        'Joel Craig', 'Ryder Brady', 'Simon Bishop', 'Jonah Cross', 'Preston Quinn', 'Grant Beck', 
        'Felix Marshall', 'Cody Miles', 'Tristan Cole', 'Ezekiel Salgado', 'Malachi Lynch', 'Jude Hawkins',
        'Liam Brown', 'Noah Wilson', 'Oliver Martin', 'Elijah Clark', 'William Lewis', 'James Hall', 
        'Benjamin Young', 'Lucas Allen', 'Henry Wright', 'Alexander Scott', 'Mason Torres', 'Michael Nelson', 
        'Ethan Baker', 'Jacob Campbell', 'Daniel Parker', 'Logan Adams', 'Jackson Evans', 
        'Sebastian Cruz', 'Aiden Ramirez', 'Matthew Rivera', 'David Lopez', 'Joseph Hill', 'Samuel Hernandez', 
        'Owen Butler', 'Jack Sanchez', 'John Ramirez', 'Thomas Foster', 'Nathan Martinez', 'Levi Garcia', 
        'Caleb Hughes', 'Isaac Morales', 'Ryan Chavez', 'Luke Reyes', 'Andrew Castillo', 'Joshua Vega', 
        'Gabriel Torres', 'Carter Ramirez', 'Dylan Gonzalez', 'Christian Ruiz', 'Hunter Mendoza', 'Aaron Flores', 
        'Eli Rios', 'Isaiah Vargas', 'Nathaniel Perez', 'Wyatt Ortiz', 'Ezra Alvarez', 'Anthony Vargas', 
        'Charles Gutierrez', 'Nicholas Castillo', 'Julian Herrera', 'Grayson Jimenez', 'Adam Rodriguez', 
        'Christopher Navarro', 'Adrian Bautista', 'Jonathan Salazar', 'Miles Delgado', 'Evan Santiago', 
        'Dominic Pacheco', 'Connor Villanueva', 'Cole Luna', 'Parker Vargas', 'Roman Padilla', 
        'Hudson Moreno', 'Gavin Arriaga', 'Brandon Espinoza', 'Kevin Rubio', 'Leo Marquez', 'Landon Serrano', 
        'Jason Leon', 'Eric Solis', 'Zachary Medina', 'Austin Ramirez', 'Elliot Rivera', 'Bryson Valencia', 
        'Justin Lozano', 'Camden Arellano', 'Xavier Cervantes', 'Bentley Rocha', 'Carson Aguilar', 
        'Maxwell Molina', 'Sawyer Valdez', 'Luca Rivera', 'Calvin Ochoa', 'Tyler Mendez', 'Asher Duarte', 
        'Finn Carrillo', 'Nolan Peralta', 'Easton Cisneros', 'Marcus Trejo', 'Victor Zamora', 'Elias Montoya', 
        'Alex Dominguez', 'Theo Varela', 'Jake Luna', 'Oscar Rivera', 'Blake Solano', 'Damian Vargas', 
        'Chase Gallardo', 'Max Espinosa', 'Colton Lozano', 'Joel Nunez', 'Ryder Salinas', 'Simon Cardenas', 
        'Jonah Calderon', 'Preston Huerta', 'Grant Esparza', 'Felix Camacho', 'Cody Trujillo', 
        'Tristan Delacruz', 'Ezekiel Salgado', 'Malachi Meza', 'Jude Escobar', 'Nathan Deleon', 'Elliott Beltran', 
        'Sullivan Contreras', 'Dominique Acosta', 'Phillip Vega', 'Brent Montiel', 'Bryant Paredes', 
        'Harrison Zapata', 'Lawrence Serrano', 'Frederick Cardona', 
        'Geoffrey Manzano', 'Jasper Olvera', 'Quincy Valenzuela', 'Cedric Avila',
    ];
      function randomColor() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
@endphp

                            @if ($video->videoComment->isEmpty())
                                <p class="pt-1 no-comment" style="text-align:center;font-size:0.8rem;">No comments available</p>
                                
                            @else
                                @foreach ($video->videoComment as $index => $videocomment)
   @php
        $author = $authorNames[array_rand($authorNames)];
        $initial = strtoupper($author[0]); // Get the first letter of the author's name
        $backgroundColor = randomColor();  // Generate a random background color
    @endphp
                                    <div style="display: none !important;" class="d-flex flex-row gap-4 px-2 py-2 comment-render" data-index="{{ $index }}">
                                        <!--------------- CONTEUDO QUE VERIFICA SE A IMAGEM EXISTE --------------->
                                        
                                       <div class="">
    <div class="rounded-full comment-avatar2" id="avatar-{{$index}}">
        <span id="initial-{{$index}}" style="display: none; text-align: center;">{{ $initial }}</span>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function checkImage(url, success, failure) {
        var img = new Image();
        img.onload = success;
        img.onerror = failure;
        img.src = url;
    }

    // Formatar o nome do autor no JavaScript
    var authorFormatted = '{{ $author }}'.replace(/\s+/g, '_');

    checkImage(
        '{{ asset("storage/avatars/") }}/' + authorFormatted + '.jpg',
        function() {
            var avatar = document.getElementById('avatar-{{$index}}');
            avatar.style.backgroundImage = "url('{{ asset('storage/avatars/') }}/" + authorFormatted + ".jpg')";
            avatar.style.backgroundSize = 'cover';
        },
        function() {
            var avatar = document.getElementById('avatar-{{$index}}');
            avatar.style.backgroundColor = '{{ $backgroundColor }}';
            document.getElementById('initial-{{$index}}').style.display = 'block';
        }
    );
});
</script>

                                    <!--------------- FIM DO CONTEUDO QUE VERIFICA SE A IMAGEM EXISTE --------------->
                                        
                                        <div class="">
                                            {{-- Row for  edit and delete buttons start here --}}
                                            <div class="row">
                                                <div style="padding-right:15px !important" class="col-12 p-0">
                                                
                                                    <span style="font-size: 11px;font-weight:500;word-break: break-word;overflow-wrap: break-word;word-wrap: break-word;white-space: normal;">
                                                        <span style="font-weight: 500; color: hsl(0deg 0% 0% / 60%);">{{ $author }}</span> 
                                                    {{ $videocomment->comment }}</span>
                                                </div>
    
                                                {{-- <div class="col-3 p-0"> --}}
                                                {{-- <i class="fa-solid fa-ellipsis-vertical"></i> --}}
                                                {{-- <button class="btn p-0 opacity-50 pe-1"
                                                        style="font-size: 0.6rem"><i
                                                            class="fa-solid fa-pen"></i></button>
    
                                                    <button class="btn p-0 opacity-50 me-1"
                                                        style="font-size: 0.6rem"><i
                                                            class="fa-solid fa-trash"></i></button> --}}
                                                {{-- </div> --}}
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
    
                        <div id="alert-fg" class="alert m-0 mt-0 rounded-0 mb-0 px-3 py-2 border-top">
                            <div class="d-flex align-items-center gap-2">
                                <div class="user-avatar-container">
                                     <div class="rounded-full user-avatar">
                                    U
                                </div>
                                </div>
                               
                          <input type="text" placeholder="Add Comment" class="form-control add-comment-input" />
                          <div class="send-comment-container">
                              <button class="send-btn-comment">
                                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M3.3938 2.20468C3.70395 1.96828 4.12324 1.93374 4.4679 2.1162L21.4679 11.1162C21.7953 11.2895 22 11.6296 22 12C22 12.3704 21.7953 12.7105 21.4679 12.8838L4.4679 21.8838C4.12324 22.0662 3.70395 22.0317 3.3938 21.7953C3.08365 21.5589 2.93922 21.1637 3.02382 20.7831L4.97561 12L3.02382 3.21692C2.93922 2.83623 3.08365 2.44109 3.3938 2.20468ZM6.80218 13L5.44596 19.103L16.9739 13H6.80218ZM16.9739 11H6.80218L5.44596 4.89699L16.9739 11Z" fill="#000000"/>
</svg>
                              </button>
                          </div>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="button-of-showchat">
                        <button class="btn-chat">Show Chat</button>
                    </div>
                    {{-- Top chat card end here --}}
    
                    {{-- short videos section start here --}}
                    <div class="short-videos mt-2 px-0 ms-1">
 <div class="button-container d-flex overflow-auto">
        <button class="youtube-btn2 bg-dark text-white dd-whitsr">All</button>
        <button class="youtube-btn2 dd-whitsr">From</button>
        <button class="youtube-btn2 dd-whitsr">Webcams</button>
        <button class="youtube-btn2 dd-whitsr">Tourism</button>
    </div>
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
                                                    style="font-size: 0.6rem"> <i class="fa-solid fa-pen"></i> Edit</a>
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
                            <div style="">
                                @foreach ($video->videoThumbnail as $videoThumbnail)
                                    <div class="card-body">
                                        <div class="thbm row mb-2" data-id="{{ $videoThumbnail->id }}">
                                            <div class="col-6 f-container2 p-0">
    
                                       <img src="{{ asset('storage/' . $videoThumbnail->img_name) }}"
                                                    alt="Uploaded Image" class="uploaded-image">
                                            </div>
                                            <div class="col-6 sm-container-wrapper">
                                              <div class="lgcontainer">
                                                                              <h5  class="image-title">
                                                    {{ $videoThumbnail->title }}</h5>
                                              
                                                
                                                
                                                                                                    <div class="d-flex align-items-center mt-1 gap-2">
                    <span class="image-text2 d-block">{{ $videoThumbnail->channel_name }}
                    
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="10" viewBox="0 0 24 24" width="10" focusable="false" aria-hidden="true" style="fill: #606060;">
    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.8 17.3l-4.2-4.1L7 11.8l2.8 2.7L17 7.4l1.4 1.4-8.6 8.5z"></path>
</svg>

                    
                    </div>
                                              </div>
                                              <div class="smcontainer">
                                                  <div class="d-flex mt-3 gap-2">
                                                       <img src="{{ $videoThumbnail->channel_avatar ? asset('storage/' . $videoThumbnail->channel_avatar) : asset('storage/profile_picture/placeholder-image.jpg') }}" class="img-fluid rounded-full"
                                        style="height:2.5rem;width:2.5rem;object-fit: cover"> 
                                        
                                         <div class="d-flex flex-column pp-container">
                                             <h5  class="image-title">
                                                    {{ $videoThumbnail->title }}</h5>
                                                    <div class="d-flex align-items-center gap-2">
                                                           <div class="d-flex align-items-center gap-1">
                                                        <span class="image-text2 d-block">{{ $videoThumbnail->channel_name }} </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 0 24 24" width="15" focusable="false" aria-hidden="true" style=""><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.8 17.3l-4.2-4.1L7 11.8l2.8 2.7L17 7.4l1.4 1.4-8.6 8.5z"></path></svg>
                                                    </div>
                                                         <span class="image-text2 d-block">42K views</span>
                                                    </div>
                                                 
                                                    
                                             
                                         </div>
                                         <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000" class="bi bi-three-dots-vertical">
  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
</svg>
                                        
                                        
                                        
                                                  </div>
                                              </div>
                                                <input type="text" class="d-none"
                                                    value="{{ $videoThumbnail->title }}" name="sug_video_name[]">
                                                <input type="text" class="d-none"
                                                    value="{{ $videoThumbnail->title }}" name="sug_video_description[]">
                                                <span class="image-text d-block views-wrap">42K views</span>
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
    
    
            {{-- <a href="{{ route('video.view', $video->uuid) }}" id="saveBtn"
                class="btn save-btn shadow mb-2  d-flex mx-auto py-2 px-5 mt-3 btn-primary">
                <span class="mx-auto">View</span>
            </a> --}}
    
    
    
        </div>
    </div>

    <script>
        $(document).ready(function() {
            
            
                $('.add-comment-input').on('input', function() {
        if ($(this).val().trim().length > 0) {
            $('.user-avatar-container, .send-comment-container').fadeIn();
        } else {
            $('.user-avatar-container, .send-comment-container').fadeOut();
        }
    });
    
    
           
    $('.close-icon').on('click', function() {
        $('.chatbox-container').hide();
        $('.btn-chat').show();
    });

  
    $('.btn-chat').on('click', function() {
        $('.chatbox-container').show();
        $(this).hide();
    });

    
    if ($('.chatbox-container').is(':visible')) {
        $('.btn-chat').hide();
    } else {
        $('.btn-chat').show();
    }
    var minNum = parseInt("{{$video->details_video_minnum}}");
var maxNum = parseInt("{{$video->details_video_maxnum}}");
var currentNum = minNum;

function updateRandomNumber() {
    var incrementRange = [1, 2, 3, 5, 7, 10,15,20,11,23,12]; // Smaller increments
    var randomIncrement = incrementRange[Math.floor(Math.random() * incrementRange.length)];

    if (Math.random() < 0.5) {
        currentNum += randomIncrement;
        if (currentNum > maxNum) {
            currentNum = maxNum;
        }
    } else {
        currentNum -= randomIncrement;
        if (currentNum < minNum) {
            currentNum = minNum;
        }
    }

    animateNumber(currentNum);
}

function animateNumber(finalValue) {
    const $element = $("#showMaxNumValue");
      const $likesElement = $("#showMaxNumValueComment");
    const formattedValue2 = formatNumber(finalValue);
    const currentText = $element.text().replace(/[^0-9]/g, ''); // Get the current number only
    const startValue = parseInt(currentText) || minNum;
    const duration = 8000; // Slower animation duration in milliseconds (8 seconds)
    const startTime = performance.now();

    function update(currentTime) {
        const elapsedTime = currentTime - startTime;
        const progress = Math.min(elapsedTime / duration, 1); // Ensure progress stays between 0 and 1
        const value = Math.floor(startValue + (finalValue - startValue) * progress);
        const formattedValue = value.toLocaleString();

        $element.text(formattedValue + " watching now");
         $likesElement.text(formattedValue2);

        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }

    requestAnimationFrame(update);
}

function formatNumber(value) {
    if (value >= 1000 && value < 1000000) {
        return (value / 1000).toFixed(1) + "K";
    } else if (value >= 1000000) {
        return (value / 1000000).toFixed(1) + "M";
    } else {
        return value.toString();
    }
}
// Increase the interval to slow down the rate of updates
var intervalId = setInterval(updateRandomNumber, 4000); // Update every 8 seconds

            let comments = $('.comment-render');
            let currentIndex = 0;

        
            comments.hide();


            function getRandomInterval(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }


         
            
            
   function addComment(commentText) {
    let commentTemplate = `
        <div id="commentL" class="d-flex flex-row align-items-center gap-4 px-2 py-2 comment-render my-comment mdd">
            <div class="">
                <div class="rounded-full user-avatar2">
                    U
                </div>
            </div>
            <div class="">
                <div class="row">
                    <div style="padding-right:15px !important" class="col-12 p-0">
                        <span style="font-size: 11px;font-weight:500;word-break: break-word;word-wrap: break-word;overflow-wrap: break-word;white-space: normal;">
                            <span style="font-weight: 500; color: hsl(0deg 0% 0% / 60%);">You</span> 
                            ${commentText}
                        </span>
                    </div>
                </div>
            </div>
        </div>`;
    
    $('.live-comments').append(commentTemplate);

    // Scroll to the bottom to ensure the new comment is visible
    let liveCommentsContainer = $('.live-comments');
    liveCommentsContainer.scrollTop(liveCommentsContainer.prop("scrollHeight"));

    $('.add-comment-input').val('');
    $('.user-avatar-container, .send-comment-container').fadeOut();
}


$('.send-btn-comment').on('click', function() {
    let commentText = $('.add-comment-input').val().trim();
    $('.no-comment').hide();

    if (commentText !== '') {
        addComment(commentText);
        
$.ajax({
    url: "{{ route('generate.comment.ajax') }}",
    method: "POST",
    data: {
        _token: "{{ csrf_token() }}",
        commentText: commentText
    },
    success: function(response) {
        if (response.message === 'Response generated') {
function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

let authorNames = [
    'John Doe', ',Jane Smith', 'Alex Johnson', 'Chris Lee', 
    'Patricia Brown', 'Michaella Davis', 'Jessica Garcia', 'Matthew Martinez',
    'Liam O Connor', 'Sofia Rossi', 'Lucas Oliveira', 'Isabella Fernández',
    'Ethan Patel', 'Mia Kowalski', 'Benjamin Silva', 'Ava Nguyen', 
    'Noah Muller', 'Oliver Chen', 'Emily Ivanov', 'Aria Ward', 
    'Henry Clark', 'Layla Harris', 'Chloe Martin', 'Daniela Singh', 
    'Sophie Dubois', 'Oscar Gómez', 'Elena Petrova', 'Mohammed Al-Farsi', 
    'Aisha Khan', 'Yuki Tanaka', 'Javier Morales', 'Camila Santos', 
    'Ravi Mehta', 'Zara Ahmed', 'Nina Popov', 'Fernando Ruiz', 
    'Clara Jansen', 'William Thompson', 'Amara Okafor', 'Mason Kim', 
    'Hiroshi Yamamoto', 'Fatima El-Sayed', 'Emily Kim', 'Sebastian Schwarz', 
    'Lara Fischer', 'Ahmed Mustafa', 'Victor Hughes', 'Dmitry Kozlov', 
    'Priya Sharma', 'Gabriella Costa', 'Katarina Novak', 'Leonardo Romano', 
    'Yasmin Ali', 'Jakub Nowak', 'Hannah Carter', 'jheniffer Jenkins', 
    'Matteo Ricci', 'Maria Rodrigues', 'Yusuf Ibrahim', 'Elsa Svensson', 
    'Nikolai Volkov'
];


shuffle(authorNames);

            response.comments.forEach(function(comment, index) {
                let author = authorNames[Math.floor(Math.random() * authorNames.length)];
                let initial = author.charAt(0).toUpperCase();
                let backgroundColor = randomColor();

                let newCommentHtml = 
                    `<div style="display: none !important;" class="d-flex flex-row gap-4 px-2 py-2 comment-render" data-index="${index}">
                        <div class="">
                            <div class="rounded-full comment-avatar2" style="background-color: ${backgroundColor};">
                                ${initial}
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-12 p-0">
                                    <span style="font-size: 11px;font-weight:500;word-break: break-word;word-wrap: break-word;overflow-wrap: break-word;white-space: normal;">
                                        <span style="font-weight: 500; color: hsl(0deg 0% 0% / 60%);">${author}</span> 
                                        ${comment}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;

                let newCommentElement = $(newCommentHtml);

                // Add the new comment element to the comments queue
                comments = comments.add(newCommentElement);
            });

            // Trigger the display of the new comments if not already running
            if (currentIndex < comments.length) {
                showComment();
            }
        } else {
            alert('Failed to generate a response. Please try again.');
        }
    },
    error: function() {
        alert('An error occurred. Please try again.');
    }
});
    }
});

function randomColor() {
    return '#' + Math.floor(Math.random() * 16777215).toString(16);
}

function showComment() {
    if (currentIndex < comments.length) {
        let newComment = $(comments[currentIndex]).clone().appendTo('.live-comments').slideDown();
        newComment.css({
            marginBottom: '',
            height: 'auto',
            overflow: 'visible'
        });

        // Ajusta o scroll para o novo comentário
        let liveCommentsContainer = $('.live-comments');
        newComment[0].scrollIntoView({ behavior: 'smooth', block: 'end' });

        currentIndex++;

        // Usa o min_Sec fixo de 2 segundos e o max_Sec calculado
        let minSec = 2; // Fixo em 2 segundos
        let maxSec = {{ isset($commentfrequeny) ? $commentfrequeny->max_Sec : 60 }};
        
        // Calcula o intervalo em milissegundos
        let interval = maxSec * 1000; // Usa diretamente o maxSec como intervalo fixo
        setTimeout(showComment, interval);
    }
}

function getRandomInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Render initial comments from bottom to top
const initialCommentsToShow = Math.min(2, comments.length);
for (let i = initialCommentsToShow - 1; i >= 0; i--) {
    $(comments[i]).appendTo('.live-comments').show();
    currentIndex++;
}

// Start showing new comments if there are any left
if (currentIndex < comments.length) {
    showComment();
}


      $('.add-comment-input').on('keypress', function(e) {
        if (e.which === 13) { 
            let commentText = $(this).val().trim();
 $('.no-comment').hide();
            if (commentText !== '') {
                addComment(commentText);
            }
            
            $.ajax({
    url: "{{ route('generate.comment.ajax') }}",
    method: "POST",
    data: {
        _token: "{{ csrf_token() }}",
        commentText: commentText
    },
    success: function(response) {
        if (response.message === 'Response generated') {
         function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

let authorNames = [
    'John Doe', ',Jane Smith', 'Alex Johnson', 'Chris Lee', 
    'Patricia Brown', 'Michaella Davis', 'Jessica Garcia', 'Matthew Martinez',
    'Liam O Connor', 'Sofia Rossi', 'Lucas Oliveira', 'Isabella Fernández',
    'Ethan Patel', 'Mia Kowalski', 'Benjamin Silva', 'Ava Nguyen', 
    'Noah Muller', 'Oliver Chen', 'Emily Ivanov', 'Aria Ward', 
    'Henry Clark', 'Layla Harris', 'Chloe Martin', 'Daniela Singh', 
    'Sophie Dubois', 'Oscar Gómez', 'Elena Petrova', 'Mohammed Al-Farsi', 
    'Aisha Khan', 'Yuki Tanaka', 'Javier Morales', 'Camila Santos', 
    'Ravi Mehta', 'Zara Ahmed', 'Nina Popov', 'Fernando Ruiz', 
    'Clara Jansen', 'William Thompson', 'Amara Okafor', 'Mason Kim', 
    'Hiroshi Yamamoto', 'Fatima El-Sayed', 'Emily Kim', 'Sebastian Schwarz', 
    'Lara Fischer', 'Ahmed Mustafa', 'Victor Hughes', 'Dmitry Kozlov', 
    'Priya Sharma', 'Gabriella Costa', 'Katarina Novak', 'Leonardo Romano', 
    'Yasmin Ali', 'Jakub Nowak', 'Hannah Carter', 'jheniffer Jenkins', 
    'Matteo Ricci', 'Maria Rodrigues', 'Yusuf Ibrahim', 'Elsa Svensson', 
    'Nikolai Volkov'
];


shuffle(authorNames);

            response.comments.forEach(function(comment, index) {
                let author = authorNames[Math.floor(Math.random() * authorNames.length)];
                let initial = author.charAt(0).toUpperCase();
                let backgroundColor = randomColor();

                let newCommentHtml = 
                    `<div style="display: none !important;" class="d-flex flex-row gap-4 px-2 py-2 comment-render" data-index="${index}">
                        <div class="">
                            <div class="rounded-full comment-avatar2" style="background-color: ${backgroundColor};">
                                ${initial}
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-12 p-0">
                                    <span style="font-size: 11px;font-weight:500;word-break: break-word;word-wrap: break-word;overflow-wrap: break-word;white-space: normal;">
                                        <span style="font-weight: 500; color: hsl(0deg 0% 0% / 60%);">${author}</span> 
                                        ${comment}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;

                let newCommentElement = $(newCommentHtml);

                // Add the new comment element to the comments queue
                comments = comments.add(newCommentElement);
            });

            // Trigger the display of the new comments if not already running
            if (currentIndex < comments.length) {
                showComment();
            }
        } else {
            alert('Failed to generate a response. Please try again.');
        }
    },
    error: function() {
        alert('An error occurred. Please try again.');
    }
});
        }
    });
 
 function handleMobileScreen() {
        if ($(window).width() <= 768) { 
            $('html, body').animate({ scrollTop: 0 }, 'fast', function() {
                $('.chatbox-container').fadeIn();
                $('html, body').css({
                    'overflow': 'hidden',
                    'height': '100%',
                    'position': 'fixed',
                    'width': '100%',
                });
            });
        }
    }

   
    handleMobileScreen();



        $('.video-comment-container').on('click', function() {

       $('html, body').animate({ scrollTop: 0 }, 'fast', function() {
   
            $('.chatbox-container').fadeIn();
               $('html, body').css({
            'overflow': 'hidden',
            'height': '100%',
            'position': 'fixed',
            'width': '100%',
        });
        });
    });
       $('#closeIconSm').on('click', function() {
      
        $('.chatbox-container').fadeOut();
           $('html, body').css({
        'overflow': '',
        'height': '',
        'position': '',
        'width': '',
    }); 
    });

    
        });
        
        
        document.querySelector('.button-container').addEventListener('wheel', (event) => {
    if (event.deltaY > 0) {
        event.target.scrollBy({left: 100, behavior: 'smooth'});
    } else {
        event.target.scrollBy({left: -100, behavior: 'smooth'});
    }
});

    </script>
 
    <!-- ======== main-wrapper end =========== -->
    @if (Session::has('success'))
        <script>
            $(document).ready(function() {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: "{{ Session::get('success') }}"

                })
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            $(document).ready(function() {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: "{{ Session::get('error') }}"

                })
            });
        </script>
    @endif
    <!-- ========= All Javascript files linkup ======== -->
    @vite('resources/js/app.js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myJqueryTable').DataTable();
        })
    </script>
    
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const descriptionElement = document.getElementById("showDescription");
    if (descriptionElement) {
        let text = descriptionElement.innerHTML;

        // Expressão regular para identificar URLs
        const urlRegex = /((https?:\/\/|www\.)[^\s<]+)/g;

        // Transformar URLs em links clicáveis
        const clickableText = text.replace(urlRegex, function (url) {
            let link = url.startsWith("http") ? url : `http://${url}`;
            return `<a href="${link}" target="_blank">${url}</a>`;
        });

        descriptionElement.innerHTML = clickableText;
    }
});
</script>

</body>

</html>
