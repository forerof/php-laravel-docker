@extends('layouts.app')

@section('title', 'Register')

@section('content')

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Crear una cuenta</h2>
                        <p>Inicio <span>-</span> Registrarse</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">

            {{-- Lado izquierdo (igual que login) --}}
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>¿Ya tienes una cuenta?</h2>
                        <p>Inicia sesión para continuar comprando con nosotros.</p>
                        <a href="{{ route('login') }}" class="btn_3">Iniciar sesión</a>
                    </div>
                </div>
            </div>

            {{-- Formulario de registro --}}
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">

                        <h3>Crear tu cuenta<br>
                            Únete a nosotros ahora
                        </h3>

                        <form method="POST" action="{{ route('register') }}" class="row contact_form">
                            @csrf

                            {{-- Name --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name') }}" placeholder="Nombre completo" required>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" placeholder="Correo electrónico" required>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" name="password"
                                       placeholder="Contraseña" required>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" name="password_confirmation"
                                       placeholder="Confirmar contraseña" required>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" name="phone"
                                       value="{{ old('phone') }}" placeholder="Número de teléfono">
                                @error('phone')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" name="address"
                                       value="{{ old('address') }}" placeholder="Dirección">
                                @error('address')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn_3">
                                    Crear cuenta
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
