<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            // Use fixed theme images (choose one of three)
            'image_url' => $this->faker->randomElement([
                'https://themewagon.github.io/aranoz/img/product/product_1.png',
                'https://themewagon.github.io/aranoz/img/product/product_2.png',
                'https://themewagon.github.io/aranoz/img/product/product_3.png',
            ]),
            'alt_text' => $this->faker->words(3, true),
            'is_primary' => $this->faker->boolean(20),
        ];
    }
}
