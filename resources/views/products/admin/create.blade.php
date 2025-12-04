@extends('layouts.app')

@section('title', 'Admin - Create Product')

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Registro de producto</h2>
                        <p>Dashboard <span>-</span> registrar nuevo producto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container dashboard-container">

    @include('layouts.partials.sliderbar')

    <div class="dashboard-content">
        <h3>Nuevo producto</h3>
        <p class="mb-4">Complete el formulario para agregar un nuevo producto.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.store') }}" class="row">
            @include('products.admin._form')

            <div class="col-md-12 form-group mt-3">
                <button type="submit" class="btn btn-primary">Guarda producto</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </form>

    </div>

</div>

@endsection
