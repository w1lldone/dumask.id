<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dumask.id</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    </head>

    
    <body class="relative antialiased">
        <div id="app" class="items-top d-flex flex-column justify-content-between min-h-screen sm:items-center sm:pt-0 sm:p-3">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow rounded relative w-100">
                <div class="container py-0">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="img-fluid" src="{{ asset('img/logo_navbar.svg')}}" alt="Dumask.id">
                    </a>
                </div>
            </nav>
            
              
              @yield('content')
        </div>
      <script src="{{ mix('/js/app.js') }}"></script>
  </body>
  @include('layouts.footer')
</html>