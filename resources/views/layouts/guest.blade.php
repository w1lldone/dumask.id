<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dumask.id</title>
        @env('production')
            <meta name="google-site-verification" content="ZQmYpcWC-8MF6KLnmUF_rYWNLh10NSrhICri74g17gU">
        @endenv

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}"> --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>

    
    <body class="relative antialiased", style="height: 100vh;">
        @yield('content')
    </body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
