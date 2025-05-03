<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
        integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"
        integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Custom styles for Instagram template -->
    <style>
        body {
            background-color: #000;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
            position: fixed;
        }
        
        .container-fluid {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }
        
        .row {
            width: 100%;
            margin: 0;
            height: 100%;
        }
        
        .col-12 {
            padding: 0;
            height: 100%;
        }
        
        #instagram-preview-template {
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
            border-radius: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            height: 100% !important;
        }
        
        /* Responsividade para dispositivos móveis */
        @media (max-width: 767px) {
            .position-relative.w-100.mx-auto {
                max-width: 100% !important;
                width: 100% !important;
                height: 100% !important;
                aspect-ratio: unset !important;
            }
            
            /* Garantir que controles inferiores fiquem visíveis */
            .position-absolute.bottom-0 {
                bottom: 0 !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 1000 !important;
            }
            
            /* Ajuste para o container de comentários */
            #live-comments {
                bottom: 72px !important;
                height: 200px !important;
            }
        }
        
        /* Específicamente para dispositivos Android */
        @media screen and (-webkit-min-device-pixel-ratio:0) {
            .android-device {
                width: 100vw !important;
                height: 100% !important;
                overflow: hidden !important;
            }
            
            #instagram-video-container, 
            #instagram-video-container iframe, 
            .video-wrapper {
                width: 100vw !important;
                max-width: 100vw !important;
                left: 0 !important;
                right: 0 !important;
            }
        }
        
        /* Especificamente para iPhone */
        @media screen and (device-width: 375px) and (device-height: 812px),
               screen and (device-width: 390px) and (device-height: 844px),
               screen and (device-width: 414px) and (device-height: 896px),
               screen and (device-width: 428px) and (device-height: 926px) {
            body {
                height: calc(100% - env(safe-area-inset-bottom));
            }
            
            .position-absolute.bottom-0 {
                bottom: env(safe-area-inset-bottom) !important;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Detectar se é um dispositivo Android
            if(/Android/i.test(navigator.userAgent)) {
                document.body.classList.add('android-device');
            }
            
            // Script específico para Instagram
            function updateRandomNumber() {
                var incrementRange = [1, 2, 3, 5, 7, 10, 15];
                var randomIncrement = incrementRange[Math.floor(Math.random() * incrementRange.length)];

                if (Math.random() < 0.7) {
                    var currentVal = parseInt($('#showMaxNumValue').text().replace(/\./g, '').replace(/,/g, ''));
                    currentVal += randomIncrement;

                    // Formata o número para o padrão brasileiro com pontos como separadores de milhar
                    var formattedVal = currentVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    
                    $('#showMaxNumValue').text(formattedVal);
                    $('#showMaxNumValue').addClass('text-pulse');
                    
                    setTimeout(function() {
                        $('#showMaxNumValue').removeClass('text-pulse');
                    }, 500);
                }
                
                // Define o próximo intervalo aleatório para atualização
                var nextUpdate = Math.floor(Math.random() * (8000 - 2000 + 1)) + 2000;
                setTimeout(updateRandomNumber, nextUpdate);
            }
            
            // Inicia a atualização dos números
            setTimeout(updateRandomNumber, 3000);
            
            // Ajustar tamanho e posição para dispositivos móveis
            function adjustForMobile() {
                if (window.innerWidth <= 767) {
                    document.documentElement.style.height = '100%';
                    document.body.style.height = '100%';
                }
            }
            
            // Executar no carregamento e no redimensionamento
            adjustForMobile();
            window.addEventListener('resize', adjustForMobile);
        });
    </script>
</body>
</html>
