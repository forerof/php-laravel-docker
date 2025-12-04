@extends('layouts.app')

@section('title', 'Set New Password')

@section('content')

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Set New Password</h2>
                        <p>Home <span>-</span> Reset Password</p>
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
                        <h2>Back to Login?</h2>
                        <p>Sign in to continue with your account.</p>
                        <a href="{{ route('login') }}" class="btn_3">Log in</a>
                    </div>
                </div>
            </div>

            {{-- Reset Password Form --}}
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">

                        <h3>Reset Your Password<br>
                            Enter a new password below</h3>

                        <form method="POST" action="{{ route('password.update') }}" class="row contact_form">
                            @csrf

                            {{-- Token --}}
                            <input type="hidden" name="token" value="{{ request()->token }}">

                            {{-- Email --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ request()->email }}"
                                       placeholder="Email"
                                       required>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- New Password --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="New Password"
                                       required>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       placeholder="Confirm New Password"
                                       required>
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn_3">
                                    Reset Password
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
