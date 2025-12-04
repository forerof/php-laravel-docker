@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Dashboard</h2>
                        <p>Inicio <span>-</span> Dashboard</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container dashboard-container">

    {{-- Sidebar del Dashboard --}}
    @include('layouts.partials.sliderbar')

    {{-- Contenido principal --}}
    <div class="dashboard-content">
        <h3>Actualizar Perfil</h3>
        <p class="mb-4">Administra tu información personal a continuación.</p>

        <form method="POST" action="{{ route('profile.update') }}" class="row" > 
            @csrf
            @method('PUT')

            {{-- Success message --}}
            @if (session('status') === 'profile-updated')
                <div class="col-12 mb-3">
                    <div class="alert alert-success">Perfil actualizado correctamente.</div>
                </div>
            @endif

            {{-- Nombre --}}
            <div class="col-md-6 form-group p_star">
                <label>Nombre Completo</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Tu Nombre">
                @if ($errors->has('name'))
                    <span class="text-danger small">{{ $errors->first('name') }}</span>
                @elseif ($errors->hasBag('updateProfileInformation') && $errors->getBag('updateProfileInformation')->has('name'))
                    <span class="text-danger small">{{ $errors->getBag('updateProfileInformation')->first('name') }}</span>
                @endif
            </div>

            {{-- Email --}}
            <div class="col-md-6 form-group p_star">
                <label>Correo Electrónico</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Tu Correo Electrónico">
                @if ($errors->has('email'))
                    <span class="text-danger small">{{ $errors->first('email') }}</span>
                @elseif ($errors->hasBag('updateProfileInformation') && $errors->getBag('updateProfileInformation')->has('email'))
                    <span class="text-danger small">{{ $errors->getBag('updateProfileInformation')->first('email') }}</span>
                @endif
            </div>

            {{-- Teléfono --}}
            <div class="col-md-6 form-group p_star mt-3">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="Número de Teléfono">
                @if ($errors->has('phone'))
                    <span class="text-danger small">{{ $errors->first('phone') }}</span>
                @elseif ($errors->hasBag('updateProfileInformation') && $errors->getBag('updateProfileInformation')->has('phone'))
                    <span class="text-danger small">{{ $errors->getBag('updateProfileInformation')->first('phone') }}</span>
                @endif
            </div>

            {{-- Dirección --}}
            <div class="col-md-6 form-group p_star mt-3">
                <label>Dirección</label>
                <input type="text" class="form-control" name="address" value="{{ old('address', auth()->user()->address) }}" placeholder="Dirección">
                @if ($errors->has('address'))
                    <span class="text-danger small">{{ $errors->first('address') }}</span>
                @elseif ($errors->hasBag('updateProfileInformation') && $errors->getBag('updateProfileInformation')->has('address'))
                    <span class="text-danger small">{{ $errors->getBag('updateProfileInformation')->first('address') }}</span>
                @endif
            </div>

            {{-- Bio --}}
            <div class="col-md-12 form-group p_star mt-3">
                <label>Bio</label>
                <textarea class="form-control" name="bio" rows="4" placeholder="Short description">{{ old('bio', auth()->user()->bio) }}</textarea>
                @if ($errors->has('bio'))
                    <span class="text-danger small">{{ $errors->first('bio') }}</span>
                @elseif ($errors->hasBag('updateProfileInformation') && $errors->getBag('updateProfileInformation')->has('bio'))
                    <span class="text-danger small">{{ $errors->getBag('updateProfileInformation')->first('bio') }}</span>
                @endif
            </div>

            {{-- Botón --}}
            <div class="col-md-12 mt-4">
                <button type="submit" class="btn_3">Guardar Cambios</button>
            </div>

        </form>

    </div>

</div>

@endsection
