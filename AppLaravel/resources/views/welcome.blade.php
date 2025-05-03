<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- font awesom cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('storage/css/landingpage.css') }}">
    
       <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="font-family: 'Roboto', sans-serif  !important;">
 <style>
     .footer-bar-icons{
         cursor:pointer;
     }
     .section-two .btn {
     transition:all 0.3s ease-in-out;
     border: 1px solid #0054d3;
}
     .section-two .btn:hover {
         color:#0054d3;
         background-color:#FFFFFF;
     }
       .section-three .btn {
     transition:all 0.3s ease-in-out;
     border: 1px solid #0054d3;
}
.header .btn {
 transition:all 0.3s ease-in-out;
 border:1px solid #4ee48a;
}
.header .btn:hover {
    background-color:#FFFFFF;
    color : #4ee48a;
    
}
.section-five .container .btn {
 transition:all 0.3s ease-in-out;
 border:1px solid #4ee48a;
}
.section-five .container .btn:hover {
    background-color:#FFFFFF;
    color : #4ee48a;
    
}

     .section-three .btn:hover {
         color:#0054d3;
         background-color:#FFFFFF;
     }
     .section-four .boxes .choose-plan-btn {
      transition:all 0.3s ease-in-out;
       border: 1px solid #0054d3;
}
.section-four .boxes .choose-plan-btn:hover{
       color:#0054d3;
         background-color:#FFFFFF;
}
       .section-six .btn {
     transition:all 0.3s ease-in-out;
     border: 1px solid #0054d3;
}
     .section-six .btn:hover {
         color:#0054d3;
         background-color:#FFFFFF;
     }
     .navbar-nav li a:hover{
         text-decoration:underline;
     }
     .footer-section a:hover{
         text-decoration:underline !important;
     }
     .plan-card{
     display:flex;
     flex-direction:column;
     justify-content:space-between;
     }
     .accordion-button{
         flex-direction:row-reverse;
             justify-content: left;
     }
     .accordion-button::after{
         margin-right:15px;
         margin-left: 0 !important;
     }
     .accordion-button::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
       background-image: url("data:image/svg+xml,%3Csvg fill='%23ffffff' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 45.402 45.402' xml:space='preserve' stroke='%23ffffff'%3E%3Cg id='SVGRepo_bgCarrier' stroke-width='0'%3E%3C/g%3E%3Cg id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'%3E%3C/g%3E%3Cg id='SVGRepo_iconCarrier'%3E%3Cg%3E%3Cpath d='M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z'%3E%3C/path%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-size: 1.25rem;
    transition: transform .2s ease-in-out, background-image .2s ease-in-out;
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg id='SVGRepo_bgCarrier' stroke-width='0'%3E%3C/g%3E%3Cg id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'%3E%3C/g%3E%3Cg id='SVGRepo_iconCarrier'%3E%3Cpath d='M1 10L1 6L15 6V10L1 10Z' fill='%23ffffff'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
    transform: rotate(180deg);
}
.accordion-button:not(.collapsed) {
    color: #ffffff;
    background-color: transparent !important;
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .125);
}
.accordion-button{
        color: #ffffff;
        border: 1px solid #ffffff;
    background-color: transparent !important;
        font-size: 20px;
    font-weight: 600;
}
.accordion-body {
    padding: 1rem 1.25rem;
    color: #C5C5C5;
    font-size: 17px;
    font-weight: 400;
}
.accordion-item{
    background:transparent;
        border: 1px solid #ffffff;
}

     
      @media screen and (max-width: 767px) {
       .header-main-image{
           width:100% !important;
               padding-top: 0px !important;
       }
       .mb-header-div{
           width:96% !important;
       }

}
     @media (min-width: 768px) and (max-width: 1023px) {
.header-main-image {
    padding-top: 1px !important;
}
.card-package{
    height:36rem !important;
}
.section-four .box-header {
    align-items:center;
}
.section-four .boxes .box-header .box-title {
    font-size: 1.975rem;
}
.section-four .dollar {
    font-size: 28px;
}
.section-four b {
    font-size: 28px;
}
.section-four .boxes li {
    font-size: 22px;
}
.section-four .popular-btn {
 
    font-size: 22px;
}

}
     @media (min-width: 1024px) and (max-width: 1279px) {
.navbar .nav-link {
    
    font-size: 12px !important;
    
}
.navbar-nav{
    margin:0 !important;
}
.header-main-image{
         
               padding-top: 0px !important;
       }
       .hero-title {
    width: 75%;
}
    .offset-lg-4 {
        margin-left: 14.333333%;
    }
    .section-five .container .btn{
        width:46%;
    }
    .section-four .boxes .box-header .box-title {
    font-size: 0.875rem;
}
.section-four .box-header {
    align-items: center;

}
}
     
 </style>
    <!-- Section one start here -->
    <section class="section-one navbar-header-bg-image "
        style="background-color:#10042F;">
        <!-- Navbar start -->
        <nav class="navbar  navbar-expand-lg pb-2 "
            style="    position: fixed;
top: -15px;
z-index: 64 !important;
width: 100%;
background:#1E1346;">
            <div class="container">
                <a class="navbar-brand" href="{{ route('profileManagement') }}">

                    <img src="{{ asset('storage/sitelogo/logo_dark.webp') }}" alt="" style="width:11rem;">
                </a>
                <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon "></span> -->

                    <img src="{{ asset('storage/sitelogo/menu.png') }}" alt="" style="height:3rem"
                        class="rounded-1">
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="navbar-nav me-auto pb-1 pt-1 mb-2 mb-lg-0 gap-2 offset-lg-1">
    <li class="nav-item">
        <a class="nav-link active text-capitalize" aria-current="page" href="#chat_experience">
            {{ __('home.ai_chat_experience') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-capitalize" href="#live_streaming">
            {{ __('home.live_streaming') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-capitalize" href="#pricing">
            {{ __('home.pricing') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-capitalize" href="#featured_videos">
            {{ __('home.featured_videos') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-capitalize" href="#stream_control">
            {{ __('home.stream_control') }}
        </a>
    </li>
</ul>

                 <li class="nav-item dropdown btn dropdown-btn rounded-pill py-0 px-0 pb-1 mx-lg-2 list-unstyled">
    <a class="nav-link dropdown-toggle py-1 text-capitalize" href="#" id="navbarDropdown"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ __('home.language') }}
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius:5px;">
        <li><a class="dropdown-item" href="{{ url('locale/en') }}">
            

<!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
<svg height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 512 512" xml:space="preserve">
<circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"/>
<g>
	<path style="fill:#D80027;" d="M244.87,256H512c0-23.106-3.08-45.49-8.819-66.783H244.87V256z"/>
	<path style="fill:#D80027;" d="M244.87,122.435h229.556c-15.671-25.572-35.708-48.175-59.07-66.783H244.87V122.435z"/>
	<path style="fill:#D80027;" d="M256,512c60.249,0,115.626-20.824,159.356-55.652H96.644C140.374,491.176,195.751,512,256,512z"/>
	<path style="fill:#D80027;" d="M37.574,389.565h436.852c12.581-20.529,22.338-42.969,28.755-66.783H8.819
		C15.236,346.596,24.993,369.036,37.574,389.565z"/>
</g>
<path style="fill:#0052B4;" d="M118.584,39.978h23.329l-21.7,15.765l8.289,25.509l-21.699-15.765L85.104,81.252l7.16-22.037
	C73.158,75.13,56.412,93.776,42.612,114.552h7.475l-13.813,10.035c-2.152,3.59-4.216,7.237-6.194,10.938l6.596,20.301l-12.306-8.941
	c-3.059,6.481-5.857,13.108-8.372,19.873l7.267,22.368h26.822l-21.7,15.765l8.289,25.509l-21.699-15.765l-12.998,9.444
	C0.678,234.537,0,245.189,0,256h256c0-141.384,0-158.052,0-256C205.428,0,158.285,14.67,118.584,39.978z M128.502,230.4
	l-21.699-15.765L85.104,230.4l8.289-25.509l-21.7-15.765h26.822l8.288-25.509l8.288,25.509h26.822l-21.7,15.765L128.502,230.4z
	 M120.213,130.317l8.289,25.509l-21.699-15.765l-21.699,15.765l8.289-25.509l-21.7-15.765h26.822l8.288-25.509l8.288,25.509h26.822
	L120.213,130.317z M220.328,230.4l-21.699-15.765L176.93,230.4l8.289-25.509l-21.7-15.765h26.822l8.288-25.509l8.288,25.509h26.822
	l-21.7,15.765L220.328,230.4z M212.039,130.317l8.289,25.509l-21.699-15.765l-21.699,15.765l8.289-25.509l-21.7-15.765h26.822
	l8.288-25.509l8.288,25.509h26.822L212.039,130.317z M212.039,55.743l8.289,25.509l-21.699-15.765L176.93,81.252l8.289-25.509
	l-21.7-15.765h26.822l8.288-25.509l8.288,25.509h26.822L212.039,55.743z"/>
</svg>
             English
        </a></li>
        <li><a class="dropdown-item" href="{{ url('locale/pt') }}">
            <svg height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 512 512" xml:space="preserve">
<circle style="fill:#6DA544;" cx="256" cy="256" r="256"/>
<polygon style="fill:#FFDA44;" points="256,100.174 467.478,256 256,411.826 44.522,256 "/>
<circle style="fill:#F0F0F0;" cx="256" cy="256" r="89.043"/>
<g>
	<path style="fill:#0052B4;" d="M211.478,250.435c-15.484,0-30.427,2.355-44.493,6.725c0.623,48.64,40.227,87.884,89.015,87.884
		c30.168,0,56.812-15.017,72.919-37.968C301.362,272.579,258.961,250.435,211.478,250.435z"/>
	<path style="fill:#0052B4;" d="M343.393,273.06c1.072-5.524,1.651-11.223,1.651-17.06c0-49.178-39.866-89.043-89.043-89.043
		c-36.694,0-68.194,22.201-81.826,53.899c12.05-2.497,24.526-3.812,37.305-3.812C263.197,217.043,309.983,238.541,343.393,273.06z"
		/>
</g>
</svg> Português
        </a></li>
    </ul>
</li>



                    @auth
                    @else
                        <li class="nav-item btn mt-lg-0 login-btn rounded-pill py-0 px-1 pb-1 list-unstyled">
                            <a class="nav-link py-1" href="{{ route('login') }}">{{ __('home.login') }}</a>

                        </li>
                    @endauth





                </div>
            </div>
        </nav>
        <!-- Navbar end -->



        <!-- Container start here -->
        <div class="container mt-5  ">
            <!-- Header start here -->
            <div class="header ">
                <!-- Row start -->
                <div class="row text-center">
                    <div class="col-12 col-lg-7 mx-auto mt-5 hero-title">
               <h1 class="mt-5 fs-title-ks">{{ __('home.stream_live') }}<br>{{ __('home.ultimate_experience') }}</h1>
<p class="mt-5 mx-auto">{{ __('home.immerse_description') }}</p>
<!--<a href="#navigate-section" class="btn mt-2 py-2 px-3">{{ __('home.get_started') }}</a>-->

                    </div>
                </div>
                <!-- Row end -->
            </div>
        </div>
        <!-- Container end here -->


        <div class="header-bg-image position-relative w-75 mx-auto mb-header-div">
            <img src="{{ asset('storage/landingpage/liveturb-plataform-quadrado-3.webp') }}"
                class="img-fluid mt-4 d-flex mx-auto w-75 h-100 pt-55 header-main-image">
                
<p class="after-img-p">{{ __('home.start_experience') }}</p>


<div class="d-flex justify-content-center align-items-center mt-5 mb-1">
    
    <a href="#navigate-section" class="trial-button mb-1">{{ __('home.trial') }}</a>
</div>

<p class="after-img-p">{{ __('home.explainer') }}</p>
            <!--<img src="{{ asset('storage/landingpage/header1.png') }}"-->
            <!--    class="position-absolute top-0  start-0 w-25 mt-lg-0 mt-4">-->
            <!--<img src="{{ asset('storage/landingpage/header2.png') }}"-->
            <!--    class="position-absolute  top-0 offset-8 ps-lg-4 ps-0 w-25 mt-lg-4 mt-4">-->
            <!--<img src="{{ asset('storage/landingpage/header3.png') }}"-->
            <!--    class="position-absolute bottom-0 start-0 w-25 pb-lg-5 pb-3 pe-lg-5 pe-2">-->
            <!--<img src="{{ asset('storage/landingpage/header4.png') }}"-->
            <!--    class="position-absolute bottom-0  end-0 w-25 pb-lg-5 pb-3 ps-lg-4 ps-2">-->


        </div>


    </section>
    <!-- Section one end here -->


    <!-- Section two start -->
    <section class="section-two pt-5 z-1" id="chat_experience">
        <!-- Container start here -->
        <div class="container ">
            <!--  Row start-->
            <div class="row mt-0 mt-lg-5 z-1 mg-row fx-row">

                <div class="col-12 col-lg-6 mg-column">
                    <div class="card border-0 mt-4">
              <div class="card-body">
                  <div class="row">
                      <div class="col-sm-12 col-lg-6">
                          <h5 class="fx-title mx-auto">{{ __('home.problem_vsl') }}
    </h5>
                      </div>
                      <div class="col-sm-12 col-lg-6 m-auto">
                           <img src="{{ asset('storage/landingpage/down2.png') }}" class="fx-img">
                      </div>  
                      <div class="col-sm-12 col-md-12 col-lg-12">
                          <p class="fx-para mt-4 mb-5">
                              {{ __('home.problem_para') }}
                          </p>
                      </div>
                     
                  </div>
                       <div class="row">
                      <div class="col-sm-12 col-lg-6">
                          <h5 class="fx-title2">{{ __('home.live_turb_solution') }}
    </h5>
                      </div>
                      <div class="col-sm-12 col-lg-6 m-auto">
                           <img src="{{ asset('storage/landingpage/up.png') }}" class="fx-img">
                      </div>  
                      <div class="col-sm-12 col-md-12 col-lg-12">
                          <p class="fx-para mt-4 mb-4">
                              {{ __('home.live_turb_solution_para') }}
                          </p>
                      </div>
                     
                  </div>
    <!--              <div class="d-flex align-items-center">-->
    <!--                      <h5 class="card-title">{{ __('home.interactive_ai') }}-->
       
    <!--    {{ __('home.chat_experience') }}-->
    <!--</h5>-->
    <!-- <img src="{{ asset('storage/landingpage/Ai.png') }}" class="ai-image mt-1 mt-lg-0">-->
    <!--              </div>-->


    <!--<p class="card-text mt-4">-->
    <!--    {{ __('home.customize_chat') }}-->
    <!--    <br>-->
    <!--    {{ __('home.seamlessly_integrated') }}-->
    <!--</p>-->
    <!--<button class="btn mt-3 py-2 shadow px-3">{{ __('home.explore_more') }}</button>-->
    
    <div class="d-flex justify-content-center align-items-center mt-4 mb-1">
    
    <a href="#navigate-section" class="trial-button2 mb-1">{{ __('home.trial') }}</a>
</div>
</div>

                    </div>
                </div>

                <div class="col-11 col-lg-6 mg-column">
                    <div class="card border-0 positino-relative fx-wrapper">
                        <img src="{{ asset('storage/landingpage/liveturb-plataform-quadrado-3.webp') }}" class="img-fluid after-image-section m-auto"
                            alt="...">

                        <!--<div class="mt-5">-->
                        <!--    <div class="position-absolute bottom-0 end-0">-->
                                <!-- Nested row start here -->
                        <!--        <div class="row">-->
                        <!--            <div class="col-lg-12 col-8">-->
                        <!--                <img src="{{ asset('storage/landingpage/chat-small-image.png') }}"-->
                        <!--                    class="img-fluid  offset-11 offset-lg-4 " alt="...">-->
                        <!--            </div>-->
                        <!--        </div>-->
                                <!-- Nested row end here -->

                        <!--    </div>-->
                        <!--</div>-->

                    </div>

                </div>

            </div>
            <!--  Row end-->
        </div>
        <!-- Container end here -->

    </section>
    <!-- Section two end -->



    <!-- Section three start here -->
    <hr class="bg-transparent mt-0 mb-0 z-1" id="live_streaming">
    <section class="section-three z-1">
        <!-- Container three end here -->
        <div class="container w-75">
            <!-- Row start -->
            <div class="row g-0">

                <div class="col-12 col-lg-6">
                    <div class="card border-0">
                        <img src="{{ asset('storage/landingpage/youtube-live-2.jpg') }}" class="img-fluid fx-image-2">
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="card border-0">
                     <div class="card-body">
    <h5 class="fx-title3 mb-4">{{ __('home.s4_heading') }}</h5>

    <p class="card-text">
        <!--"{{ __('home.experience_thrill') }}"-->
        <!--<br>-->
        <!--{{ __('home.never_miss_moment') }}-->
        
        <ul class="fx-bullets p-0 mb-4">
    <li>{!! __('home.step1') !!}</li>
    <li>{!! __('home.step2') !!}</li>
    <li>{!! __('home.step3') !!}</li>
</ul>
    </p>
     <div class="d-flex justify-content-center align-items-center mt-5 mb-1">
    
    <a href="#navigate-section" class="trial-button2 mb-1">{{ __('home.trial') }}</a>
</div>
</div>
                    </div>
                </div>

            </div>
            <!-- Row end -->

        </div>
        <!-- Container three end here -->

    </section>
    <!-- Section three end here -->


    <!-- Section four start here -->
    <section id="navigate-section" class="section-four z-1">

        <!-- Container three start here -->
        <div class="container mt-lg-5 pt-lg-5 mt-5 ">

            <!-- Row start -->
            <div class="row section-four-text  text-center" id="pricing">
                <div class="col-12 col-lg-12 mx-auto">
          <div class="card border-0">
    <h5 class="card-title mb-4">{{ __('home.tailored_subscription_plans') }}</h5>
    <p class="card-text">{{ __('home.explore_flexible_plans') }}</p>
</div>


                </div>
            </div>
            <!-- Row end -->


            <!-- Row start -->
            <div class="row mt-5 pt-5 boxes g-0">
@foreach ($plans as $plan)
    @if ($plan->name == 'Basic')
        <div class="col-12 mt-3 col-lg-4">
            <div class="card p-4 align-self-center rounded-5 w-75 float-end first-card-height card-package">
                <!-- Nested row start -->
                <div class="row box-header">
                    <div class="col-3">
                        <img src="{{ asset('storage/landingpage/basic.png') }}" class="card-img-top img-fluid images" alt="...">
                    </div>
                    <div class="col-5">
                        <h5 class="box-title">{{ __('home.basic_plan') }}</h5>
                        <span class="dollar">R$</span>
                        <b>{{ number_format($plan->price) }}</b>
                        <span class="dollar">/
                            @if ($plan->duration == 12)
                                {{ __('home.month') }}
                            @else
                                {{ $plan->duration }} {{ __('home.month') }}
                            @endif
                        </span>
                    </div>
                    <div class="col-3 text-end">
                        <button class="btn popular-btn mt-0 rounded-pill py-0">{{ __('home.popular') }}</button>
                    </div>
                    <hr class="hr mt-2">
                </div>
                <!-- Nested row end-->

                <div class="card-body p-0 plan-card">
                    <ul class="p-0 plan-ul mb-0">
                        <li class="list-unstyled mt-0">{{ __('home.access_hd_content') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.expanded_content_library') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.seamless_content_selection') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.seamless_content_selection2') }}</li>
                    </ul>
                    @auth
                        <!-- Add your form here if needed -->
                    @else
                        <a href="{{ route('register.form', $plan->uuid) }}" class="btn btn choose-plan-btn fs-5 w-100 py-3">
                            {{ __('home.choose_plan') }} <i class="fa-solid fa-arrow-right mx-2"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    @elseif($plan->name == 'Standard')
        <div class="col-12 col-lg-4 mt-5 mt-lg-0">
            <div class="card p-4 align-self-start mt-3 mt-lg-0 rounded-5 middle-card-height card-package">
                <!-- Nested row start -->
                <div class="row box-header">
                    <div class="col-3">
                        <img src="{{ asset('storage/landingpage/standard.png') }}" class="card-img-top img-fluid images" alt="...">
                    </div>
                    <div class="col-5">
                        <h5 class="box-title">{{ __('home.standard_plan') }}</h5>
                        <span class="dollar">R$</span>
                        <b>{{ number_format($plan->price) }}</b>
                        <span class="dollar">/ {{ __('home.month') }}</span>
                    </div>
                    <div class="col-3 text-end">
                        <button class="btn popular-btn rounded-pill py-0">{{ __('home.popular') }}</button>
                    </div>
                </div>
                <!-- Nested row end-->

                <hr class="hr">

                <div class="card-body p-0 plan-card">
                    <ul class="p-0 plan-ul">
                <li class="list-unstyled mt-0">{{ __('home.access_hd_content_standard') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.expanded_content_library') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.seamless_content_selection_standard') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.seamless_content_selection2_standard') }}</li>
                    </ul>
                    @auth
                        <!-- User is not registered -->
                    @else
                        <a href="{{ route('register.form', $plan->uuid) }}" class="btn btn choose-plan-btn fs-5 w-100 mt-lg-5 mt-5 py-3">
                            {{ __('home.choose_plan') }} <i class="fa-solid fa-arrow-right mx-2"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    @elseif($plan->name == 'Premium')
        <div class="col-12 mt-3 col-lg-4">
            <div class="card align-self-center py-4 px-2 rounded-5 w-75 third-card-height card-package">
                <!-- Nested row start -->
                <div class="row box-header">
                    <div class="col-3">
                        <img src="{{ asset('storage/landingpage/premium.png') }}" class="card-img-top img-fluid images images pb-4" alt="...">
                    </div>
                    <div class="col-5">
                        <h5 class="box-title">{{ __('home.premium_plan') }}</h5>
                        <span class="dollar">R$</span>
                        <b>{{ number_format($plan->price) }}</b>
                        <span class="dollar">/ {{ __('home.month') }}</span>
                    </div>
                    <div class="col-3 text-end">
                        <button class="btn popular-btn rounded-pill py-0">{{ __('home.popular') }}</button>
                    </div>
                    <hr class="hr">
                </div>
                <!-- Nested row end-->

                <div class="card-body plan-card px-2 py-0">
                    <ul class="p-0 plan-ul mb-0">
                          <li class="list-unstyled mt-0">{{ __('home.access_hd_content_premium') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.expanded_content_library') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.seamless_content_selection_premium') }}</li>
                        <li class="list-unstyled mt-4">{{ __('home.seamless_content_selection2_premium') }}</li>
                    </ul>
                    @auth
                        <!-- Add your form here if needed -->
                    @else
                        <a href="{{ route('register.form', $plan->uuid) }}" class="btn btn choose-plan-btn fs-5 w-100 py-3 mt-3">
                            {{ __('home.choose_plan') }} <i class="fa-solid fa-arrow-right mx-2"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    @endif
@endforeach


            </div>
            <!-- Row end -->

        </div>
        <!-- Container three start here -->

    </section>

    <!-- Section four start here -->

    <hr class="bg-transparent mb-0 " id="featured_videos">

    <!-- Section five start here -->
    <section class="section-five border-0 rounded-0 z-1" style="background-image: url('{{ asset('storage/landingpage/section-five-bg-imagecrop2.webp') }}');">
        <!-- Container start here -->
        <div class="container mt-0   mt-lg-5"
            >

            <!-- Row start -->
            <div class="row pb-5">
                <div class="col-12 col-lg-12 mt-5">
                 <div class="card border-0 bg-transparent p-3 pb-3">
    <h5 style="" class="fx-title-4 mb-5">{{ __('home.faq') }}</h5>
    <div class="row">
            <div class="col-12 col-lg-6">
     <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        {{ __('home.how_does_liveturb_improve') }}
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.liveturb_conversion_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        {{ __('home.are_comments_generated') }}
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.comments_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        {{ __('home.is_live_broadcast_real') }}
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.live_broadcast_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        {{ __('home.customize_everything') }}
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.customize_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFive">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        {{ __('home.how_liveturb_vsl') }}
      </button>
    </h2>
    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.liveturb_vsl_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSix">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
        {{ __('home.customize_appearance') }}
      </button>
    </h2>
    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.customize_appearance_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSeven">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
        {{ __('home.revolutionize_digital_launches') }}
      </button>
    </h2>
    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.digital_launches_explanation') }}
      </div>
    </div>
  </div>
</div>
     </div> 
     
         <div class="col-12 col-lg-6">
        <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOneUnique">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneUnique" aria-expanded="true" aria-controls="collapseOneUnique">
        {{ __('home.comments_real') }}
      </button>
    </h2>
    <div id="collapseOneUnique" class="accordion-collapse collapse show" aria-labelledby="headingOneUnique" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.comments_real_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwoUnique">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoUnique" aria-expanded="false" aria-controls="collapseTwoUnique">
        {{ __('home.viewer_interaction') }}
      </button>
    </h2>
    <div id="collapseTwoUnique" class="accordion-collapse collapse" aria-labelledby="headingTwoUnique" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.viewer_interaction_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThreeUnique">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeUnique" aria-expanded="false" aria-controls="collapseThreeUnique">
        {{ __('home.suitable_for_products') }}
      </button>
    </h2>
    <div id="collapseThreeUnique" class="accordion-collapse collapse" aria-labelledby="headingThreeUnique" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.suitable_for_products_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFourUnique">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourUnique" aria-expanded="false" aria-controls="collapseFourUnique">
        {{ __('home.simultaneous_streams') }}
      </button>
    </h2>
    <div id="collapseFourUnique" class="accordion-collapse collapse" aria-labelledby="headingFourUnique" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.simultaneous_streams_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFiveUnique">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiveUnique" aria-expanded="false" aria-controls="collapseFiveUnique">
        {{ __('home.test_before_subscription') }}
      </button>
    </h2>
    <div id="collapseFiveUnique" class="accordion-collapse collapse" aria-labelledby="headingFiveUnique" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.test_before_subscription_explanation') }}
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSixUnique">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixUnique" aria-expanded="false" aria-controls="collapseSixUnique">
        {{ __('home.support_offered') }}
      </button>
    </h2>
    <div id="collapseSixUnique" class="accordion-collapse collapse" aria-labelledby="headingSixUnique" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        {{ __('home.support_offered_explanation') }}
      </div>
    </div>
  </div>
</div>
    </div>
    </div>

    <!--<h5 style="font-size:2rem" class="card-title ">{{ __('home.recommendations') }}</h5>-->
    <!--<p class="card-text mt-3">-->
    <!--    {{ __('home.discover_personalized') }}-->
    <!--</p>-->

</div>

                </div>
                <!-- Row end -->


                <!--<div class="col-12 col-lg-7  ">-->
                <!--    <div class="card border-0 bg-transparent" style="margin-top: -25px;">-->
                <!--        <img src="{{ asset('storage/landingpage/for-web.png') }}"-->
                <!--            class="d-lg-block d-md-block d-none shadow">-->
                <!--        <img src="{{ asset('storage/landingpage/for-mobile.png') }}"-->
                <!--            class="d-lg-none d-md-none d-block shadow mb-5">-->
                <!--    </div>-->
                <!--</div>-->

            </div>
        </div>
        <!-- Container end here -->

    </section>
    <!-- Section five start here -->




    <!-- Section six start here -->
    <section class="section-six mt-2 pt-lg-2 z-1" id="stream_control">
        <!-- Container six end here -->
        <div class="container mt-lg-5">
            <!-- Row start -->
            <div class="row ">

                <div class="col-12 col-lg-12">
                    <div class="card border-0 pt-0 mt-0">
                 <div class="card-body">
    <h5 class="fx-title-5 mb-5">{{ __('home.si5_heading') }}</h5>
    <h5 class="fx-para-2 mb-5">{{ __('home.si5_para') }}</h5>
<div class="d-flex justify-content-center align-items-center mb-1">
    
    <a href="#navigate-section" class="trial-button2 mb-1">{{ __('home.start_now') }}</a>
</div>
    <!--<p class="card-text mt-4">-->
    <!--    "{{ __('home.unlock_full_potential') }}"-->
    <!--    <br>-->
    <!--    {{ __('home.real_time_moderation') }}-->
    <!--</p>-->
    <!--<button class="btn mt-3 py-2 fw-bold shadow px-3">{{ __('home.take_control_now') }}</button>-->
</div>
                    </div>
                </div>

                <!--<div class="col-12 col-lg-7">-->
                <!--    <div class="card border-0 mt-5 mt-lg-0 ">-->
                <!--        <img src="{{ asset('storage/landingpage/section-six-image.png') }}" class="section-image ">-->
                <!--    </div>-->
                <!--</div>-->


            </div>
            <!-- Row end -->

        </div>
        <!-- Container six end here -->

    </section>
    <!-- Section six end here -->


    <!-- Footer section start -->
    <section class="footer-section pb-1 pb-lg-2  footer-bg-image  shadow mt-2 " style="background-color:#0A142F">

        <!-- Container start -->

        <div class="container w-75  px-4 px-lg-0 footer  pb-lg-0 ">
            <!-- Row start -->
            <div class="row py-5">

                <div class="col-12 col-lg-6">

                    <div class="card bg-transparent w-75 border-0 ">
                        <div class="w-50 p-0" style="margin-left: -2rem">
                            <!--<img src="{{ asset('storage/landingpage/logo.png') }}" class="card-img-top"-->
                            <!--    class="">-->
                           <a href="{{route('landing')}}">
                                      <img class="ms-0" src="{{ asset('storage/sitelogo/logo_dark.webp') }}" alt=""
                                style="width:11rem">

                           </a>
                     
                        </div>

                      <div class="card-body pt-2">
    <p class="card-text">
        {{ __('home.welcome_message') }}
    </p>
</div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="card bg-transparent border-0">
                     <div class="card-body">
    <div class="card-title fs-6 ">{{ __('home.company') }}</div>
    <a href="#" class="text-decoration-none">
        <span class="card-text d-block mt-3 text-capitalize">{{ __('home.about_us') }}</span>
    </a>
   
    <a href="#" class="text-decoration-none">
        <span class="card-text d-block mt-1 text-capitalize">{{ __('home.pricing') }}</span>
    </a>
    
     <a href="#" class="text-decoration-none">
        <span class="card-text d-block mt-1 text-capitalize">{{ __('home.contact_us') }}</span>
    </a>
</div>

                    </div>
                </div>



                <div class="col-lg-3 col-6">
<div class="card bg-transparent border-0">
    <div class="card-body">
        <div class="card-title fs-6 text-uppercase">{{ __('home.legal') }}</div>
        <a href="{{route('termsUse')}}" class="text-decoration-none">
            <span class="card-text d-block mt-3 text-capitalize">{{ __('home.terms_of_use') }}</span>
        </a>
        <a href="{{route('privacyPolicy')}}" class="text-decoration-none">
            <span class="card-text d-block mt-1 text-capitalize">{{ __('home.privacy_policy') }}</span>
        </a>
        <div class="footer-btn-container mt-4">
    <a class="footer-button" href="https://www.youtube.com/@LiveTurb" target="_blank" title="LiveTurb YouTube">
        <svg style="position: relative;top: -1px;" class="e-font-icon-svg e-fab-youtube" width="16" height="16" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
        </svg>


  
            </a>
            <a class="footer-button" href="https://www.instagram.com/liveturb" target="_blank" title="LiveTurb Instagram">
        <svg class="e-font-icon-svg e-fab-instagram" style="position: relative;top: -1px;" viewBox="0 0 448 512" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6-7.8 34.7-22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
        </svg>
            </a>
        </div>
    </div>
</div>

                </div>


                <!-- Row end -->
            </div>

            <!--<hr class="bg-light">-->

            <!-- Row start -->

            <!-- Row end -->
<!--            <div class="row footer-bar py-2 pb-lg-0">-->
<!--                <div class="col-6 col-lg-7 pt-2 pb-2 text-lg-end">-->
<!--    <a href="#" class="text-decoration-none text-light"><span>{{ __('home.terms') }}</span></a>-->
<!--    <a href="#" class="text-decoration-none text-light"><span class="mx-3">{{ __('home.privacy') }}</span></a>-->
<!--    <a href="#" class="text-decoration-none text-light"><span>{{ __('home.cookies') }}</span></a>-->
<!--</div>-->

<!--                <div class="col-6 col-lg-5 pb-1 text-end">-->
<!--                    <img src="{{ asset('storage/landingpage/linkedin.png') }}" class="footer-bar-icons">-->
<!--                    <img src="{{ asset('storage/landingpage/facebook.png') }}" class="footer-bar-icons">-->
<!--                    <img src="{{ asset('storage/landingpage/twitter.png') }}" class="footer-bar-icons">-->
<!--                </div>-->

<!--            </div>-->

        </div>
        <!-- Container end -->

    </section>
    <!-- Footer section end -->


    {{-- Script for scrolling to pricing section --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const section = document.getElementById('pricing');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script> --}}
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

</body>

</html>
