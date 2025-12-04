@extends('layouts.app')

@section('content')
<!-- Breadcrumb start -->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Productos</h2>
                        <p>Inicio <span>-</span> Todos los Productos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!-- Category Product Area start -->
<section class="cat_product_area section_padding">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <!-- Browse Categories -->
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Categorías</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <li>
                                    <a href="{{ route('products.index') }}">Todos los Productos</a>
                                    <span>({{ $products->total() }})</span>
                                </li>
                                @forelse($categories as $category)
                                    <li class="{{ selected_class('category', $category->slug) }}">
                                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                        class="{{ selected_class('category', $category->slug) }}">
                                        {{ $category->name }}
                                    </a>
                                        <span>({{ $category->products_count }})</span>
                                    </li>
                                @empty
                                    <li><span>No hay categorías</span></li>
                                @endforelse
                            </ul>
                        </div>
                    </aside>

                    <!-- Price Filter (simple ranges) -->
                    <aside class="left_widgets p_filter_widgets ">
                        <div class="l_w_title">
                            <h3>Precio</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <li>
                                    <a href="{{ route('products.index') }}" class="text-muted">Todos los precios</a>
                                </li>
                                <li>
                                    <a href="{{ route('products.index', array_merge(request()->except('page'), ['price' => 'under_60000'])) }}"
                                       class="{{ selected_class('price', 'under_60000') }}">
                                        Hasta $ 60.000
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('products.index', array_merge(request()->except('page'), ['price' => '60_150'])) }}"
                                       class="{{ selected_class('price', '60_150') }}">
                                        $ 60.000 a $ 150.000
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('products.index', array_merge(request()->except('page'), ['price' => 'above_150000'])) }}"
                                       class="{{ selected_class('price', 'above_150000') }}">
                                        Más de $ 150.000
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Top Bar -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center flex-wrap">
                            <div class="single_product_menu">
                                <p><span>{{ $products->total() }}</span> Productos encontrados</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row align-items-center latest_product_inner">
                    @forelse($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <a href="{{ route('products.show', $product) }}">
                                    @if($product->images->where('is_primary', true)->first())
                                        <img src="{{ $product->images->where('is_primary', true)->first()->image_url }}"
                                            alt="{{ $product->images->where('is_primary', true)->first()->alt_text ?? $product->name }}"
                                            style="height: 250px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/300x250?text={{ urlencode($product->name) }}"
                                            alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                                    @endif
                                </a>
                                <div class="single_product_text">
                                    <h4>{{ $product->name }}</h4>
                                    <h3>${{ number_format($product->price, 2) }}</h3>
                                    <form action="{{ route('cart.add') }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <a href="#" class="add_cart" onclick="event.preventDefault(); this.closest('form').submit();">+ comprar</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12">
                            <div class="alert alert-info text-center">
                                <h5>No se encontraron productos</h5>
                                <p>Intenta ajustar tu búsqueda o los filtros</p>
                            </div>
                        </div>
                    @endforelse
                    <!-- Pagination -->
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category Product Area end -->
@endsection