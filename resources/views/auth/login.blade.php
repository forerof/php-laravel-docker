@extends('layouts.app')

@section('title', 'Login')

@section('content')

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Login</h2>
                        <p>Home <span>-</span> Login</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>¿Nuevo en nuestra tienda?</h2>
                        <p>Únete a nosotros y disfruta de una experiencia de compra increíble.</p>
                        <a href="{{ route('register') }}" class="btn_3">Crear una cuenta</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>¡Bienvenido! <br> Por favor, inicia sesión ahora</h3>

                        <form method="POST" action="{{ route('login') }}" class="row contact_form">
                            @csrf
                            
                            {{-- Campo email/username --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password"  name="password" placeholder="Contraseña">
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">Recuérdame</label>
                                </div>

                                <button type="submit" class="btn_3">Iniciar sesión</button>
                            </div> 

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
