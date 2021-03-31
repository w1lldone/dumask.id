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
        <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>

    
    <body class="relative antialiased">
        <div id="app" class="items-top d-flex flex-column justify-content-between min-h-screen sm:items-center sm:pt-0 sm:p-3">
            <div class="row w-100">
                <div class="col-2 float-left">
                    <div class="card border-0 shadow my-4" style="height: 100vh; border-radius:0.75em">
                        <div class="card-body flex-column">
                            <div class="mx-auto text-center">
                                <div class="container mb-4">
                                    <a class="flex" href="{{ url('/')}}">
                                        <img class="img-fluid mx-auto w-100" src="{{ asset('img/logo_stacked.svg')}}" alt="Dumask.id">
                                    </a>
                                </div>
                                <nav>
                                    <ul class="navbar-nav text-left mr-auto">
                                        <li class="nav-item text-left">
                                            <a 
                                            class="nav-link font-weight-bold px-3 {{ Request::is('dashboard') ? 'btn-primary rounded' : 'text-secondary' }}" 
                                            href="{{ url('/dashboard')}}"
                                            >
                                            <span class="mdi mdi-view-dashboard" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Request::is('dashboard') ? '' : 'text-dark' }}">Dashboard</span>
                                            </a>
                                        </li>
                                        @can('viewAny', \App\Models\Station::class)
                                        <li class="nav-item text-left">
                                            <a 
                                            class="nav-link font-weight-bold px-3 {{ Request::is('station') ? 'btn-primary rounded' : 'text-secondary' }}" 
                                            href="{{ url('/station')}}"
                                            >
                                            <span class="mdi mdi-flag" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Request::is('station') ? '' : 'text-dark' }}">Stations</span>
                                            </a>
                                        </li>  
                                        @endcan
                                        @can('viewAny', \App\Models\User::class)
                                        <li class="nav-item text-left">
                                            <a 
                                            class="nav-link font-weight-bold px-3 {{ Request::is('user') ? 'btn-primary rounded' : 'text-secondary' }}"
                                            href="{{ url('/user')}}"
                                            >
                                            <span class="mdi mdi-account-supervisor" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Request::is('user') ? '' : 'text-dark' }}">Users</span>
                                            
                                            </a>
                                        </li>
                                        @endcan
                                        <li class="nav-item text-left">
                                            <a 
                                            class="nav-link font-weight-bold px-3 {{ Request::is('settings') ? 'btn-primary rounded' : 'text-secondary' }}"
                                            href="{{ url('/setting')}}"
                                            >
                                            <span class="mdi mdi-settings" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Request::is('settings') ? '' : 'text-dark' }}">Pengaturan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="d-flex float-right mt-4">
                        <button class="btn btn-primary rounded mx-2 shadow">
                            <span class="mdi mdi-bell" style="font-size: 16px"></span>
                        </button>
                        <button 
                            type="button" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false" 
                            class="nav-link flex-row dropdown card border-0 rounded shadow p-0"
                        >
                            <div>
                                <img 
                                class="img-fluid rounded" 
                                src="{{ asset('img/profile_photo.png')}}" 
                                alt="Profile" 
                                style="width: 40px; height: 40px"
                                >
                            </div>
                                
                            <div class="nav-link text-primary font-weight-bold dropdown-toggle">
                                {{ Auth::user()->name }}
                            </div>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item disabled" href="">Profil</a>
                            <a 
                                class="dropdown-item text-primary" 
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        
                    </div>
                    <div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
      <script src="{{ mix('/js/app.js') }}"></script>
  </body>
</html>