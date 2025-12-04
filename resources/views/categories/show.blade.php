@extends('layouts.app')

@section('title', $category->name)

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>{{ $category->name }}</h2>
                        <p>Categories <span>-</span> {{ $category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <h3>{{ $category->name }}</h3>
            <p>{{ $category->description }}</p>

            <hr>

            <h4>Products</h4>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            @if($product->images && $product->images->count())
                                <img src="{{ asset($product->images->first()->path) }}" class="card-img-top" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">${{ number_format($product->price, 2) }}</p>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">No products in this category.</div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
