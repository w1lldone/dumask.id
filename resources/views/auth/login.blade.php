@extends('layouts.guest')
@section('content')
<div class="container d-flex flex-column h-100">
    <div class="card border-0 shadow my-auto", style="border-radius: 0.5em">
        <div class="card-content">
            <a class="flex" href="{{ url('/')}}">
                <img class="img-fluid mx-auto w-100" src="{{ asset('img/logo_navbar.svg')}}" alt="Dumask.id">
            </a>
        </div>
        <div class="flex text-center">
            <a 
                href="/auth/google/redirect" 
                class="btn btn-outline-dark btn-google my-2 mx-auto"
                style="padding-right: 8px; padding-left: 8px; height: 40px"
            >
                <div class="d-flex h-100">
                    <img 
                    src="/img/icon_google.png" 
                    alt="" 
                    class="ml-auto my-auto" 
                    style="max-width: 18px; height: 18px;">
                    <span 
                    class="mr-auto my-auto" 
                    style="font-weight: 500; font-size: 14px; padding-left: 24px;"
                    >
                    Sign in with Google
                    </span>
                </div>
            </a>   
        </div>  
    <form method="POST" action="{{ route('login') }}">
        @csrf
    
        <!-- Email Address -->
        <div>
            <x-label for="email" :value="__('Email')" />
    
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>
    
        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />
    
            <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>
    
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
    
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
    
            <x-button class="ml-3">
                {{ __('Log in') }}
            </x-button>
        </div>
    </form>
    </div>
            
           
    </div>
@endsection
    