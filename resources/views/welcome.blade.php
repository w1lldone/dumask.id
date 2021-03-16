@extends('layouts.app')
@section('content')

<div class="container my-4">
    <div class="flex sm:items-center sm:pt-0 w-100">
        <div class="items-center max-w-6xl mx-auto px-sm-6 px-lg-8">
            <div class="d-flex">
                <img class="mx-auto w-75" src="{{ asset('img/sitting.png')}}" alt="Orang_duduk"> 
            </div>
            <div class="d-flex flex-column pt-2">
                <h2 class="text-center text-primary  font-weight-bold pt-2">UNDER DEVELOPMENT</h2>
                <p class="text-center font-weight-bold mb-0" style="color: #777777; font-family: 'Roboto', serif">Something Awesome is Coming Soon!</p> 
                {{-- <p class="text-center text-danger text-small font-weight-bold">Don't miss our updates</p>  --}}
            </div>
            
        </div>
    </div>
    <div class="d-flex justify-center pt-8 h-50">
        <img class="" src="{{ asset('img/logo_piat.svg')}}" alt="UGM_Logo" style="max-height: 55px"> 
    </div>
</div>

@include('layouts.footer')

@endsection
