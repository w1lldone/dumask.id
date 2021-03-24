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
            <nav class="navbar navbar-expand-md navbar-light bg-white rounded relative w-100">
                <div class="container py-0">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="img-fluid" src="{{ asset('img/logo_navbar.svg')}}" alt="Dumask.id">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a 
                                class="nav-link font-weight-bold px-3 {{ Request::is('/') ? 'text-primary' : 'text-secondary' }}" 
                                href=""
                                >
                                Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a 
                                class="nav-link text-secondary font-weight-bold px-3 {{ Request::is('/about') ? 'text-primary' : 'text-secondary' }}" 
                                href=""
                                >
                                About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a 
                                class="nav-link text-secondary font-weight-bold px-3 {{ Request::is('/contact') ? 'text-primary' : 'text-secondary' }}" 
                                href=""
                                >
                                Contact
                                </a>
                            </li>
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <login-modal></login-modal>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link text-primary font-weight-bold dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item disabled" href="">Profil</a>

                                        <a class="dropdown-item text-primary" href="{{ route('dashboard') }}" >Dashboard</a>
                                        
                                        @can('viewAny', \App\Models\User::class)
                                            <a class="dropdown-item text-primary" href="{{ route('user.index') }}" >Manage User</a>
                                            {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                                <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                                                    {{ __('Users') }}
                                                </x-nav-link>
                                            </div> --}}
                                        @endcan
                                        
                                        {{-- Logout --}}
                                        <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                           {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            
            @yield('content')
        </div>
      <script src="{{ mix('/js/app.js') }}"></script>
  </body>
  @include('layouts.footer')
</html>