@extends('layouts.guest')

@section('content')

<div id="app" class="container d-flex flex-column h-100">
    <div class="my-auto mx-auto w-md-50">
        <reset-password class="mx-4" :token='@json($request->route("token"))' :email='@json($request->email)'></reset-password>
    </div>
</div>

@endsection