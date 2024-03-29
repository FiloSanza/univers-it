<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ url('logo.png') }}" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/js/app.js', 
            'resources/js/searchbar.js', 
            'resources/js/dropdown.js', 
            'resources/js/navbar.js',
            ])
        
        @if (!is_null(Auth::user()) && Auth::user()->hasVerifiedEmail()) 
        @vite([
            'resources/js/notifications.js',
        ])
        @endif

        @if (isset($script))
            {{$script}}
        @endif

    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')
        <div class="min-h-screen bg-white">
            <!-- Page Content -->
            <main class="lg:w-3/5 lg:mx-auto">
                {{ $slot }}
            </main>
        </div>
        <footer>
            @include('layouts.footer')
        </footer>
    </body>
</html>
