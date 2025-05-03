<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a1c4e 0%, #131236 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .error-container {
            text-align: center;
            padding: 2rem;
            max-width: 90%;
            width: 600px;
        }

        .error-number {
            font-size: clamp(100px, 20vw, 200px);
            font-weight: 700;
            line-height: 1;
            margin-bottom: 1rem;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .astronaut {
            width: clamp(80px, 15vw, 150px);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        .title {
            font-size: clamp(20px, 4vw, 32px);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .message {
            font-size: clamp(16px, 3vw, 20px);
            margin-bottom: 2rem;
            color: #a8b3cf;
        }

        .go-back {
            display: inline-block;
            background: #4f46e5;
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: clamp(14px, 2.5vw, 16px);
        }

        .go-back:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        /* Stars Animation */
        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .star {
            position: absolute;
            background: #fff;
            border-radius: 50%;
            animation: twinkle var(--duration) ease-in-out infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
    </style>
</head>
<body>
    <!-- Stars Background -->
    <div class="stars" id="stars"></div>

    <div class="error-container">
        <div class="error-number">
            4
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxjaXJjbGUgY3g9Ijc1IiBjeT0iNzUiIHI9IjY1IiBmaWxsPSIjRkZGRkZGIi8+CjxwYXRoIGQ9Ik03NSAyNUM0NyAyNSAyNSA0NyAyNSA3NUM2NSA3NSA4NSA3NSAxMjUgNzVDMTI1IDQ3IDEwMyAyNSA3NSAyNVoiIGZpbGw9IiM0RjQ2RTUiLz4KPGNpcmNsZSBjeD0iNTUiIGN5PSI2MCIgcj0iOCIgZmlsbD0iIzRGNDZFNSIvPgo8Y2lyY2xlIGN4PSI5NSIgY3k9IjYwIiByPSI4IiBmaWxsPSIjNEY0NkU1Ii8+CjxwYXRoIGQ9Ik03NSA5NUw2NSAxMTVIODVMNzUgOTVaIiBmaWxsPSIjNEY0NkU1Ii8+Cjwvc3ZnPg==" alt="Astronaut" class="astronaut">
            4
        </div>
        <h1 class="title">{{ __('errors.404_title') }}</h1>
        <p class="message">{{ __('errors.404_message') }}</p>
        <a href="{{ auth()->check() ? route('myBroadcasts') : url('/') }}" class="go-back">{{ __('errors.go_back') }}</a>
    </div>

    <script>
        // Create stars
        function createStars() {
            const stars = document.getElementById('stars');
            const numberOfStars = 100;
            
            for (let i = 0; i < numberOfStars; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                
                // Random position
                const x = Math.random() * 100;
                const y = Math.random() * 100;
                
                // Random size
                const size = Math.random() * 3;
                
                // Random animation duration
                const duration = 2 + Math.random() * 3;
                
                star.style.cssText = `
                    left: ${x}%;
                    top: ${y}%;
                    width: ${size}px;
                    height: ${size}px;
                    --duration: ${duration}s;
                `;
                
                stars.appendChild(star);
            }
        }
        
        createStars();
    </script>
</body>
</html>
