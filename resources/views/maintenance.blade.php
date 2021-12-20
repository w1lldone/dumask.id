@extends('layouts.guest')

@section('content')


<div class="container">
    <div class="row py-5 justify-content-center">
        <div class="col-md-5">
            <img class="img-responsive" src="{{ asset('/img/ilus_dumask.svg')}}" alt="Orang_duduk">
            <div class="d-flex flex-column pt-2">
                <h2 class="text-center text-primary  font-weight-bold pt-2">UNDER MAINTENANCE</h2>
                <h5 class="text-center font-weight-bold mb-0">
                    Sorry, dumask.id<sup>&reg;</sup> is under maintenance. <br> please come back again soon!</h5>
                {{-- <p class="text-center text-danger text-small font-weight-bold">Don't miss our updates</p> --}}
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
