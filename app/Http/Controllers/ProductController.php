<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Product::with('category', 'images', 'reviews');

        // Category filter by slug
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        // Price filter via simple named ranges
        if ($request->filled('price')) {
            switch ($request->input('price')) {
                case 'under_60000':
                    $query->where('price', '<=', 60000);
                    break;
                case '60_150':
                    $query->whereBetween('price', [60000, 150000]);
                    break;
                case 'above_150000':
                    $query->where('price', '>', 150000);
                    break;
            }
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Admin listing of products (table view).
     */
    public function adminIndex(Request $request): View
    {
        $query = Product::with('category', 'images', 'reviews');

        $products = $query->paginate(5)->withQueryString();

        $categories = Category::all();

        return view('products.admin.index', compact('products', 'categories'));
    }

    /**
     * Show the admin form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('products.admin.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            'short_description' => 'required|string|max:255',
            'long_description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|unique:products|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $product = Product::create($validated);

        // Lista de imágenes disponibles
        $images = [
            'https://themewagon.github.io/aranoz/img/product/product_1.png',
            'https://themewagon.github.io/aranoz/img/product/product_2.png',
            'https://themewagon.github.io/aranoz/img/product/product_3.png',
        ];

        // Seleccionar 2 imágenes aleatorias
        $selectedImages = Arr::random($images, 3);

        foreach ($selectedImages as $index => $url) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url'  => $url,
                'is_primary' => $index === 0, 
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $product->load('category', 'images', 'reviews.user');
        $reviews = $product->reviews()->paginate(10);
        // Productos relacionados (misma categoría, excepto el actual)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(5)
            ->get();

        return view('products.show', compact('product', 'reviews', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.admin.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:products,name,' . $product->id . '|max:255',
            'short_description' => 'required|string|max:255',
            'long_description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|unique:products,sku,' . $product->id . '|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}
