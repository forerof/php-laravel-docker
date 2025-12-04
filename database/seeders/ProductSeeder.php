<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a random number of products per category
        // Configure range via env: PRODUCTS_PER_CATEGORY_MIN/PRODUCTS_PER_CATEGORY_MAX
        $min = max(0, (int) env('PRODUCTS_PER_CATEGORY_MIN', 1));
        $max = max($min, (int) env('PRODUCTS_PER_CATEGORY_MAX', 6));

        Category::all()->each(function ($category) use ($min, $max) {
            $count = rand($min, $max);
            if ($count === 0) {
                return; // skip creating products for this category
            }
            Product::factory($count)
                ->for($category)
                ->create()
                ->each(function ($product) {
                    // Add 2-4 images per product
                    $count = rand(2, 4);
                    ProductImage::factory($count)
                        ->for($product)
                        ->create();

                    // Ensure exactly one primary image per product and reset others
                    $product->images()->update(['is_primary' => false]);
                    $primary = $product->images()->inRandomOrder()->first();
                    if ($primary) {
                        $primary->update(['is_primary' => true]);
                    }
                });
        });
    }
}
