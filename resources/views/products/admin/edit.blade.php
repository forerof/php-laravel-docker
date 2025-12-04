@extends('layouts.app')

@section('title', 'Admin - Edit Product')

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Editar producto</h2>
                        <p>Dashboard <span>-</span> Editar producto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container dashboard-container">

    @include('layouts.partials.sliderbar')

    <div class="dashboard-content">
        <h3>Editar producto: {{ $product->name }}</h3>
        <p class="mb-4">Actualice la información del producto a continuación.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.update', $product) }}" class="row">
            @method('PUT')
            @include('products.admin._form')

            <div class="col-md-12 form-group mt-3">
                <button type="submit" class="btn btn-primary">Actualizar producto</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

</div>

@endsection
