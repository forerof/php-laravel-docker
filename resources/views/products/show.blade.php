@extends('layouts.app')

@section('title', $product->name . ' - Aranoz')

@section('content')
<!-- Breadcrumb start -->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>{{ $product->name }}</h2>
                        <p>
                            Inicio
                            <span>-</span>
                            Productos
                            <span>-</span>
                            {{ $product->name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!--================Single Product Area =================-->
<div class="product_image_area section_padding">
    <div class="container">
        <div class="row s_product_inner justify-content-between">
            <div class="col-lg-7 col-xl-7">
                <div class="product_slider_img">
                    @if($product->images->count() > 0)
                        <div id="vertical">
                            @foreach($product->images as $image)
                                <div data-thumb="{{ $image->image_url }}">
                                    <img src="{{ $image->image_url }}" alt="{{ $image->alt_text ?? $product->name }}" />
                                </div>
                            @endforeach
                        </div>
                    @else
                        <img src="https://via.placeholder.com/600x600?text={{ urlencode($product->name) }}" 
                             alt="{{ $product->name }}" 
                             style="width: 100%; object-fit: cover;">
                    @endif
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="s_product_text">
                    <h3>{{ $product->name }}</h3>
                    <h2>${{ number_format($product->price, 2) }}</h2>
                    <ul class="list">
                        <li>
                            <a class="active" href="#">
                                <span>Categoría</span> : {{ $product->category->name }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Disponible</span> : 
                                @if($product->stock > 0)
                                    <span class="text-success">En Stock</span>
                                @else
                                    <span class="text-danger">Agotado</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>SKU</span> : {{ $product->sku }}
                            </a>
                        </li>
                    </ul>
                    <p>{{ $product->short_description }}</p>
                    <div class="card_area d-flex justify-content-between align-items-center">
                        <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <div class="product_count mr-3">
                                <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                <input name="quantity" class="input-number" type="text" value="1" min="0" max="{{ $product->stock }}">
                                <span class="number-increment"> <i class="ti-plus"></i></span>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <a href="#" class="btn_3" onclick="event.preventDefault(); this.closest('form').submit();">Al carrito</a>
                        </form>
                        <a href="#" class="like_us"> <i class="ti-heart"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" 
                   aria-controls="home" aria-selected="true">Descripción</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" 
                   aria-controls="review" aria-selected="false">
                   Reseñas ({{ $product->reviews->count() }})
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Descripción -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>{{ $product->long_description }}</p>
            </div>

            <!-- Reseñas -->
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        @if($product->reviews->count() > 0)
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Promedio</h5>
                                        <h4>{{ number_format($product->average_rating, 1) }}</h4>
                                        <h6>({{ $product->reviews->count() }} Reseñas)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Basado en {{ $product->reviews->count() }} Reseñas</h3>
                                        <ul class="list">
                                            @for($i = 5; $i >= 1; $i--)
                                                @php
                                                    $count = $product->reviews->where('rating', $i)->count();
                                                @endphp
                                                <li>
                                                    <a href="#">{{ $i }} Estrella
                                                        @for($j = 0; $j < 5; $j++)
                                                            <i class="fa fa-star{{ $j < $i ? '' : '-o' }}"></i>
                                                        @endfor
                                                        {{ $count }}
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="review_list">
                                @foreach($reviews as $review)
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&size=80&background=random" 
                                                     alt="{{ $review->user->name }}" />
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $review->user->name }}</h4>
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fa fa-star{{ $i < $review->rating ? '' : '-o' }}"></i>
                                                @endfor
                                                <p class="text-muted small">{{ $review->created_at->format('d M, Y') }}</p>
                                            </div>
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Paginación de reseñas -->
                            <div class="mt-4">
                                {{ $reviews->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                <h5>No hay reseñas todavía</h5>
                                <p>Sé el primero en dejar una reseña de este producto.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Formulario para agregar reseña -->
                    <div class="col-lg-6">
                        @auth
                            <div class="review_box">
                                <h4>Agregar una Reseña</h4>
                                <p>Tu Calificación:</p>
                                <form action="{{ route('reviews.store', $product) }}" method="POST" class="contact_form">
                                    @csrf
                                    <div class="form-group">
                                        <select name="rating" id="rating-select" class="form-control" required>
                                            <option value="">Selecciona...</option>
                                            <option value="5">5 - Excelente</option>
                                            <option value="4">4 - Muy bueno</option>
                                            <option value="3">3 - Bueno</option>
                                            <option value="2">2 - Regular</option>
                                            <option value="1">1 - Malo</option>
                                        </select>
                                        <div id="rating-preview" class="mt-2" aria-hidden="true">
                                            <!-- Preview stars rendered by JS -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" rows="4" 
                                                  placeholder="Escribe tu reseña aquí..." required></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" value="submit" class="btn_3">
                                            Enviar Reseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <p>Debes <a href="{{ route('login') }}">iniciar sesión</a> para dejar una reseña.</p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->

<!-- product_list part start-->
<section class="product_list best_seller">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Productos Relacionados</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-sm-6">
                    <div class="single_product_item">
                        <a href="{{ route('products.show', $relatedProduct) }}">
                            @if($relatedProduct->images->where('is_primary', true)->first())
                                <img src="{{ $relatedProduct->images->where('is_primary', true)->first()->image_url }}" 
                                     alt="{{ $relatedProduct->name }}"
                                     style="height: 250px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300x250?text={{ urlencode($relatedProduct->name) }}" 
                                     alt="{{ $relatedProduct->name }}"
                                     style="height: 250px; object-fit: cover;">
                            @endif
                        </a>
                        <div class="single_product_text">
                            <h4>{{ $relatedProduct->name }}</h4>
                            <h3>${{ number_format($relatedProduct->price, 2) }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- product_list part end-->

@endsection

@push('scripts')
<script src="{{ asset('js/product-show.js') }}"></script>
@endpush
