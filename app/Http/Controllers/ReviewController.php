<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new review.
     */
    public function create(Product $product): View
    {
        return view('reviews.create', compact('product'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para escribir una reseña.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user already reviewed this product
        $existingReview = Review::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return redirect()->back()
                ->with('error', 'Ya has dejado una reseña para este producto.');
        }

        Review::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Reseña creada exitosamente.');
    }

    /**
     * Show the form for editing a review.
     */
    public function edit(Review $review): View
    {
        $this->authorize('update', $review);
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
        $this->authorize('update', $review);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->route('products.show', $review->product)
            ->with('success', 'Reseña actualizada exitosamente.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review): RedirectResponse
    {
        $this->authorize('delete', $review);

        $product = $review->product;
        $review->delete();

        return redirect()->route('products.show', $product)
            ->with('success', 'Reseña eliminada exitosamente.');
    }

    /**
     * Get reviews for a product (API).
     */
    public function getProductReviews(Product $product): View
    {
        $reviews = $product->reviews()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('reviews.product-reviews', compact('reviews', 'product'));
    }
}
