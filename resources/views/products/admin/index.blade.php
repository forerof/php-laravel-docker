@extends('layouts.app')

@section('title', 'Admin - Products')

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Gestión de productos</h2>
                        <p>Dashboard <span>-</span> Productos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container dashboard-container">

    @include('layouts.partials.sliderbar')

    <div class="dashboard-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Productos</h3>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Nuevo</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Stock</th>
           
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category?->name ?? '-' }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-secondary">Editar</a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Está seguro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No se encontraron productos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection
