@extends('layouts.app')

@section('title', 'Admin - Categories')

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Category Management</h2>
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
            <h3>Categories</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products_count ?? $category->products()->count() }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($category->description, 60) }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-secondary">Edit</a>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
</div>

@endsection
