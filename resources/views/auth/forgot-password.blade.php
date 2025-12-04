@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Reset Password</h2>
                        <p>Home <span>-</span> Forgot Password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">

            {{-- Lado Izquierdo --}}
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Remembered your password?</h2>
                        <p>Return to login and continue shopping.</p>
                        <a href="{{ route('login') }}" class="btn_3">Log in</a>
                    </div>
                </div>
            </div>

            {{-- Formulario Reset --}}
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">

                        <h3>Forgot your password?<br>
                            We will send a recovery link</h3>

                        {{-- STATUS MESSAGE (Laravel Breeze default) --}}
                        @if (session('status'))
                            <div class="alert alert-success mt-2">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" class="row contact_form">
                            @csrf

                            {{-- Email --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       placeholder="Email"
                                       required>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn_3">
                                    Send Reset Link
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
