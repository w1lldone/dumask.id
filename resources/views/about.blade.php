@extends('layouts.app')

@section('title', 'Tentang Dumask.id')

@section('additionalNav')
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link text-primary font-weight-bold dropdown-toggle" href="#" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <span class="mdi mdi-translate"></span> {{ strtoupper($lang) }}
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item text-primary" href="{{ route('about', 'id') }}">
            Bahasa Indonesia
        </a>

        <a class="dropdown-item text-primary" href="{{ route('about', 'en') }}">English</a>
    </div>
</li>
@endsection

@section('content')

<div class="container w-md-75 my-4">
    <div class="card rounded border-0 shadow px-4 py-2 mx-3 my-2" style="border-radius: 0.5rem">
        <h2 class="text-primary text-center font-weight-bold mt-2 mb-0">
            {{ __('about.title') }}
        </h2>
        <hr class="my-2">
        <div class="text-secondary text-center mt-4 mx-auto">
            <h5 style="line-height: 175%">
                {{ __('about.background') }}
            </h5>
        </div>
    </div>
    <div class="d-flex row text-center my-4 mx-auto">
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_1.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_2.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_8.jpeg')}}" alt="About Dumask.id">
        </div>
    </div>
    <div class="card rounded border-0 shadow px-4 py-2 mx-3 my-2" style="border-radius: 0.5rem">
        <div class="text-secondary text-center my-2 mx-auto">
            <h5 style="line-height: 175%">
                {!! __('about.definition') !!}
            </h5>
        </div>
    </div>
    <div class="d-flex row text-center my-4 mx-auto">
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_4.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_6.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_7.jpeg')}}" alt="About Dumask.id">
        </div>
    </div>
    <div class="card rounded border-0 shadow px-4 py-2 mx-3 my-2" style="border-radius: 0.5rem">
        <h5 class="text-secondary text-center font-weight-bold my-2 mb-0">
            {{ __('about.closing') }}
        </h5>
    </div>

</div>

@endsection
