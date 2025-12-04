<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();
        
        // Create 2-4 reviews per product
        $products->each(function ($product) use ($users) {
            $reviewCount = rand(2, 4);

            // Choose unique users for this product to avoid duplicate (product_id,user_id) entries
            $selectedUsers = $users->shuffle()->take(min($reviewCount, $users->count()));

            foreach ($selectedUsers as $user) {
                // Use firstOrCreate to avoid duplicates if seeder runs multiple times
                Review::firstOrCreate([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                ], [
                    'rating' => rand(1, 5),
                    'comment' => fake()->paragraph(),
                ]);
            }
        });
    }
}
