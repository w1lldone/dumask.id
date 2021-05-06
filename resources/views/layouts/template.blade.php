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


    <body class="relative antialiased" style="background-color: #EBF1F7">

        <nav class="d-md-none navbar navbar-expand-md navbar-light bg-white rounded relative w-100">
            <div class="container py-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="container my-3 px-0">
                        <a class="flex" href="{{ url('/')}}">
                            <img class="img-fluid mx-auto w-100" src="{{ asset('img/logo_navbar.svg')}}" alt="Dumask.id">
                        </a>
                    </div>
                    <ul class="navbar-nav ml-auto d-flex flex-row">
                        <div class="mb-4">
                            <button class="btn btn-primary rounded mr-2">
                                <span class="mdi mdi-bell" style="font-size: 18px"></span>
                            </button>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-row">
                                <button
                                type="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                class="nav-link flex-row dropdown card border-0 rounded p-0"
                                >
                                    <div>
                                        <img
                                        class="img-fluid rounded"
                                        src="{{ asset('img/profile_photo.png')}}"
                                        alt="Profile"
                                        style="width: 42px; height: 42px"
                                        >
                                    </div>

                                    <div class="d-flex flex-column text-left mx-2">
                                        <span class="text-primary font-weight-bold">{{ Auth::user()->name }}</span>
                                        <span class="text-dark" style="font-size: 12px">Admin</span>
                                    </div>

                                    <div class="nav-link text-left dropdown-toggle my-auto">

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
                        </div>
                    </ul>
                    <ul class="navbar-nav text-left mr-auto">
                        <li class="nav-item text-left">
                            <a
                            class="nav-link font-weight-bold px-3 {{ Route::is('dashboard.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                            href="{{ url('/dashboard')}}"
                            >
                            <span class="mdi mdi-view-dashboard" style="font-size: 18px"></span>
                            <span class="ml-2 {{ Route::is('dashboard.*') ? '' : 'text-dark' }}">Dashboard</span>
                            </a>
                        </li>
                        @can('viewAny', \App\Models\Station::class)
                        <li class="nav-item text-left">
                            <a
                            class="nav-link font-weight-bold px-3 {{ Route::is('station.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                            href="{{ url('/station')}}"
                            >
                            <span class="mdi mdi-flag" style="font-size: 18px"></span>
                            <span class="ml-2 {{ Route::is('station.*') ? '' : 'text-dark' }}">Stations</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewAny', \App\Models\User::class)
                        <li class="nav-item text-left">
                            <a
                            class="nav-link font-weight-bold px-3 {{ Route::is('user.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                            href="{{ url('/user')}}"
                            >
                            <span class="mdi mdi-account-supervisor" style="font-size: 18px"></span>
                            <span class="ml-2 {{ Route::is('user.*') ? '' : 'text-dark' }}">Users</span>

                            </a>
                        </li>
                        @endcan
                        @can('viewAny', \App\Models\Station::class)
                        <li class="nav-item text-left">
                            <a class="nav-link font-weight-bold px-3 {{ Route::is('operation.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                                href="{{ url('/operation')}}">
                                <span class="mdi mdi-scale" style="font-size: 18px"></span>
                                <span class="ml-2 {{ Route::is('operation.*') ? '' : 'text-dark' }}">Operations</span>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item text-left">
                            <a
                            class="nav-link font-weight-bold px-3 {{ Request::is('settings/*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                            href="{{ url('/setting')}}"
                            >
                            <span class="mdi mdi-settings" style="font-size: 18px"></span>
                            <span class="ml-2 {{ Request::is('settings/*') ? '' : 'text-dark' }}">Pengaturan</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <div id="app" class="items-top d-flex flex-column justify-content-between px-3 pt-3">
            <div class="row mx-auto w-100">
                <div class="col-md-2 d-none d-md-flex">
                    <div class="card border-0 shadow mt-4 sticky-top w-100" style="height: 100vh; border-radius:0.75em">
                        <div class="card-body flex-column px-2">
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
                                            class="nav-link font-weight-bold px-3 {{ Route::is('dashboard.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                                            href="{{ url('/dashboard')}}"
                                            >
                                            <span class="mdi mdi-view-dashboard" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Route::is('dashboard.*') ? '' : 'text-dark' }}">Dashboard</span>
                                            </a>
                                        </li>
                                        @can('viewAny', \App\Models\Station::class)
                                        <li class="nav-item text-left">
                                            <a
                                            class="nav-link font-weight-bold px-3 {{ Route::is('station.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                                            href="{{ url('/station')}}"
                                            >
                                            <span class="mdi mdi-flag" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Route::is('station.*') ? '' : 'text-dark' }}">Stations</span>
                                            </a>
                                        </li>
                                        @endcan
                                        @can('viewAny', \App\Models\User::class)
                                        <li class="nav-item text-left">
                                            <a
                                            class="nav-link font-weight-bold px-3 {{ Route::is('user.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                                            href="{{ url('/user')}}"
                                            >
                                            <span class="mdi mdi-account-supervisor" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Route::is('user.*') ? '' : 'text-dark' }}">Users</span>

                                            </a>
                                        </li>
                                        @endcan
                                        @can('viewAny', \App\Models\Station::class)
                                        <li class="nav-item text-left">
                                            <a class="nav-link font-weight-bold px-3 {{ Route::is('operation.*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                                                href="{{ url('/operation')}}">
                                                <span class="mdi mdi-scale" style="font-size: 18px"></span>
                                                <span class="ml-2 {{ Route::is('operation.*') ? '' : 'text-dark' }}">Operation</span>

                                            </a>
                                        </li>
                                        @endcan
                                        <li class="nav-item text-left">
                                            <a
                                            class="nav-link font-weight-bold px-3 {{ Request::is('settings/*') ? 'btn-primary text-white rounded' : 'text-secondary' }}"
                                            href="{{ url('/setting')}}"
                                            >
                                            <span class="mdi mdi-settings" style="font-size: 18px"></span>
                                            <span class="ml-2 {{ Request::is('settings/*') ? '' : 'text-dark' }}">Pengaturan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-10 pb-3">
                    <div class="d-none d-md-flex float-right mt-4">
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
                                style="width: 42px; height: 42px"
                                >
                            </div>

                            <div class="d-flex flex-column text-left mx-2">
                                <span class="text-primary font-weight-bold">{{ Auth::user()->name }}</span>
                                <span class="text-dark" style="font-size: 12px">Admin</span>
                            </div>

                            <div class="nav-link text-left dropdown-toggle my-auto">

                            </div>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a
                                class="dropdown-item text-primary"
                                href="{{ route('profile.index') }}">
                                {{ __('Profil') }}
                            </a>
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
