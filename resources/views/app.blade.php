<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- JQuery calendar stuff -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <!-- vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"]) -->
        @routes
        @vite(['resources/js/app.js','resources/css/app.css'])
        @inertiaHead
    </head>
    @php
        $hostname = $_SERVER['SERVER_NAME'];
        echo "<!-- Hostname: $hostname -->";
        switch ($hostname) {
            case '127.0.0.1':
                $theme = 'custom1';
                break;
            case 'localhost':
                $theme = 'custom2';
                break;
            default:
                $theme = 'custom1';
                break;
        }
    @endphp
    <body class="font-sans antialiased h-screen" data-theme="{{$theme}}">
        @inertia
    </body>
</html>
