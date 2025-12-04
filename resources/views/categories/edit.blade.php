@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Edit Category</h2>
                        <p>Dashboard <span>-</span> Categories</p>
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
            <h3>Edit Category</h3>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @method('PUT')
            @include('categories._form')

            <div class="mt-3">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
