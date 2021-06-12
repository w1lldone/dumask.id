<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dumask.id - @yield('title')</title>
        @env('production')
            <meta name="google-site-verification" content="ZQmYpcWC-8MF6KLnmUF_rYWNLh10NSrhICri74g17gU">

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-74RFXHTS34"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'G-74RFXHTS34');
            </script>
        @endenv

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
                                href="{{ url('/') }}"
                                >
                                Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                class="nav-link font-weight-bold px-3 {{ Request::is('about') ? 'text-primary' : 'text-secondary' }}"
                                href="{{ url('/about') }}"
                                >
                                About Us
                                </a>
                            </li>
                            <li class="nav-item d-block d-md-none">
                                <a
                                class="nav-link font-weight-bold px-3 {{ Request::is('notification') ? 'text-primary' : 'text-secondary' }}"
                                href="{{ url('/notification') }}"
                                >
                                <span class="mdi mdi-bell text-primary" style="font-size: 16px"></span>
                                Notification
                                </a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                            {{-- Additional Navigation --}}
                            @yield('additionalNav')

                            <!-- Authentication Links -->
                            @guest
                                <login-modal></login-modal>
                            @else
                                {{-- Notification --}}
                                <li class="nav-item dropdown">
                                    <a
                                        class="d-none d-md-block nav-link text-primary font-weight-bold"
                                        href="#" 
                                        role="button" 
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <span class="mdi mdi-bell text-primary" style="font-size: 16px"></span>
                                    </a>

                                    <div class="dropdown-menu py-0 mt-2 shadow" aria-labelledby="navbarDropdown">
                                        <x-notifications-component/>
                                    </div>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link text-primary font-weight-bold dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a
                                            class="dropdown-item text-primary"
                                            href="{{ route('profile.index') }}">
                                            {{ __('Profil') }}
                                        </a>

                                        <a class="dropdown-item text-primary" href="{{ route('dashboard') }}" >Dashboard</a>

                                        @can('viewAny', \App\Models\User::class)
                                            <a class="dropdown-item text-primary" href="{{ route('user.index') }}" >Manage User</a>
                                            {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                                <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                                                    {{ __('Users') }}
                                                </x-nav-link>
                                            </div> --}}
                                        @endcan
                                        @can('viewAny', \App\Models\Station::class)
                                            <a class="dropdown-item text-primary" href="{{ route('station.index') }}" >Manage Station</a>
                                        @endcan

                                        @can('viewAny', \App\Models\Station::class)
                                            <a class="dropdown-item text-primary" href="{{ route('operation.index') }}" >Operate Station</a>
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
