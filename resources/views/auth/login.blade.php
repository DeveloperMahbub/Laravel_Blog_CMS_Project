@extends('layouts.frontend.app')
@section('title','Login')
@push('css')
<link href="{{ asset('assets/frontend/css/auth/styles.css') }}" rel="stylesheet">

<link href="{{ asset('assets/frontend/css/auth/responsive.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>Login</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">
            <div class="col-lg-2 col-md-0"></div>
            <div class="col-lg-8 col-md-12">
                <div class="post-wrapper">

                    <x-guest-layout>
                            <x-slot name="logo">
                                
                            </x-slot>
                    
                            <x-jet-validation-errors class="mb-4" />
                    
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif
                    
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                    
                                <div>
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                </div>
                    
                                <div class="mt-4">
                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                </div>
                    
                                <div class="block mt-4">
                                    <label for="remember_me" class="flex items-center">
                                        <x-jet-checkbox id="remember_me" name="remember" />
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                    
                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                    
                                    <x-jet-button class="ml-4">
                                        {{ __('Log in') }}
                                    </x-jet-button>
                                </div>
                            </form>
                    </x-guest-layout>
                </div><!-- post-wrapper -->
            </div><!-- col-sm-8 col-sm-offset-2 -->
        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->

@endsection
@push('js')
    
@endpush