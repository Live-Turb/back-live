<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Styles -->
    <style>
        body {
            background: url('{{ asset('storage/sitelogo/fundo-grande.png') }}') no-repeat center center fixed;
            background-size: cover;
        }
        .blur-content {
            filter: blur(4px);
            user-select: none;
            position: relative;
            z-index: 1;
            margin-top: 8px;
            display: inline-block;
        }
        .lock-overlay {
            position: relative;
            cursor: not-allowed;
            margin-top: 1rem;
            display: inline-block;
        }
        .lock-overlay h6 {
            margin-bottom: 1rem;
        }
        .lock-overlay::after {
            content: '\f023';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5em;
            color: #7b7576;
            z-index: 2;
            pointer-events: none;
        }
        /* Ajuste específico para o texto PREMIUM */
        .alert .lock-overlay {
            margin-top: 0;
            padding: 0 15px;
            display: inline-block;
            vertical-align: middle;
        }
        .alert .lock-overlay::after {
            top: 50%;
            font-size: 1.5em; /* Mesmo tamanho dos outros cadeados */
        }
        .alert .blur-content {
            margin-top: 0;
            font-size: 1.1em;
            padding: 2px 10px;
        }
        .bg-gradient-premium {
            background: rgb(9 8 53);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 1rem;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.95);
        }
        .card-header {
            border-bottom: none;
            padding: 1.5rem;
        }
        .btn-primary {
            background: rgb(9 8 53) !important;
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
        }
        .alert-primary {
            background-color: #e8f0fe;
            border-color: #b8d3fc;
            color: #1a56db;
        }
        .logo-img {
            width: 84px;
            height: auto;
            margin-bottom: 1rem;
        }
        .stats-container {
            padding: 1rem 0;
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="min-vh-100 py-5">
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
