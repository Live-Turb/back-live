<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1089192597935409');
    fbq('track', 'PageView');
    </script>
    <noscript>
    <img height="1" width="1" style="display:none" 
    src="https://www.facebook.com/tr?id=1089192597935409&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    
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
    <link rel="stylesheet" href="{{ asset('css/analytics-flags.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/slim-select@1.26.0/dist/slimselect.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Scripts - jQuery primeiro, depois outros que dependem dele -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/slim-select@1.26.0/dist/slimselect.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    dl, ol, ul {
    margin-top: 0;
    margin-bottom: 0rem;
}
ol, ul {
    padding-left: 0rem;
}
@media screen and (max-width: 767px) {
.language-container{
    height:6rem !important;
    align-items:end !important;
}
       }

     @media (min-width: 768px) and (max-width: 1023px) {
button#menu-toggle{
    display:block !important;
}
.language-container{
    height:6rem !important;
    align-items:end !important;
}

}
     @media (min-width: 1024px) and (max-width: 1199px) {
         button#menu-toggle{
    display:block !important;
}
.language-container{
    height:6rem !important;
    align-items:end !important;
}
}
</style>
<body style="font-family: inter" class="bg-white">
    
    <!--Mobile navbar start here-->
    <div class="pb-2"
        style="position: fixed;
    top: -15px;
    z-index: 64 !important;
    width: 100%;
    background-image: url('{{ asset('storage/landingpage/nav-bg-imagen.png') }}');">
        <!-- ======== sidebar-nav start =========== -->
        <aside class="sidebar-nav-wrapper" style="background-color: var(--maincolor-side)">
            <div class="navbar-logo">
                <a href="{{ route('myBroadcasts') }}">
                    <img src="{{ asset('storage/sitelogo/Menu logo with dark background.png') }}" style="width:5rem"
                        alt="logo" />
                </a>
            </div>
           
            <nav class="sidebar-nav">
                @include('layouts.navigation')
            </nav>
        </aside>
        <button id="menu-toggle" style="display: none;margin-left:1rem;margin-top:1rem;"
            class=" border-0 p-0 border-transparent border-bottom-0 bg-transparent">
            <img src="{{ asset('storage/sitelogo/menu.png') }}" class="" style="height:3rem;" class="rounded-1">

        </button>

        <!--<li class="nav-item dropdown btn dropdown-btn d-block d-md-none d-lg-none float-end mt-3 pt-1 me-2 text-white rounded-pill py-0 px-0 pb-1  mx-lg-2 list-unstyled"-->
        <!--    style="background-color:#0A142F">-->
        <!--    <a class="nav-link dropdown-toggle text-white  py-1 text-capitalize" href="#" id="navbarDropdown"-->
        <!--        role="button" data-bs-toggle="dropdown" aria-expanded="false">-->

        <!--        English-->
        <!--    </a>-->
        <!--    <ul class="dropdown-menu " aria-labelledby="navbarDropdown" style="border-radius:5px;">-->
        <!--        <li><a class="dropdown-item" href="#"><img src="{{ asset('storage/landingpage/language.png') }}"-->
        <!--                    class="bg-transparent" class="" style="height:1rem"> Portuguese</a></li>--


        <!--    </ul>-->
        <!--</li>-->
    </div>
  
    <!--Mobile navbar end here-->
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->
  <div style="height:3rem;" class="d-flex justify-content-end align-items-center px-5 gap-3 language-container">
                 

    <a class="" href="{{ url('locale/en') }}">
            

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
        </a>
        <a class="" href="{{ url('locale/pt') }}">
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
        </a>
    </div>
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        

        <!-- ========== header start ========== -->
        <header class="header pt-3">
            <div class="container-fluid ">
                <div class="row d-none">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20 d-none">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> {{ __('Menu') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            @if (auth()->user())
                                                <h6>{{ auth()->user()->name }}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a href="{{ route('profile.show') }}"> <i class="lni lni-user"></i>
                                            {{ __('My profile') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('billing.index') }}"> <i class="lni lni-credit-cards"></i>
                                            {{ __('Visualizações e Cobranças') }}</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();"> <i
                                                    class="lni lni-exit"></i> {{ __('Logout') }}</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section ">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <!-- ========== footer start =========== -->
        <footer class="footer">
            <div class="container-fluid">
                <!--<div class="row">-->
                <!--    <div class="col-md-6 order-last order-md-first">-->
                <!--        <div class="copyright text-md-start">-->
                <!--            <p class="text-sm">-->
                <!--                Designed and Developed by-->
                <!--                <a href="https://plainadmin.com" rel="nofollow" target="_blank">-->
                <!--                    PlainAdmin-->
                <!--                </a>-->
                <!--            </p>-->
                <!--        </div>-->
                <!--    </div>-->
                <!-- end col-->
                <!--</div>-->
                <!-- end row -->
            </div>
            <!-- end container -->
        </footer>
        <!-- ========== footer end =========== -->
    </main>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.3.3/dist/js/jsvectormap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.3.3/dist/maps/world.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    @stack('scripts')
    <script>
        $(document).ready(function() {
            // Verificar se a tabela existe antes de inicializar o DataTable
            if ($('#myJqueryTable').length > 0) {
                $('#myJqueryTable').DataTable();
            }
        })
    </script>
</body>

</html>
