<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and gadgets',
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Apparel and fashion items',
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'description' => 'Physical and digital books',
            ],
            [
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Furniture and garden supplies',
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'Sports equipment and accessories',
            ],
        ];

        foreach ($categories as $category) {
            // Use firstOrCreate to avoid duplicate entries when seeding multiple times
            Category::firstOrCreate([
                'slug' => $category['slug'],
            ], $category);
        }
    }
}
