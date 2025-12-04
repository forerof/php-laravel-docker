<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'short_description' => $this->faker->sentence(),
            'long_description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(50000, 100000, 300000),
            'category_id' => Category::factory(),
            'stock' => $this->faker->numberBetween(0, 100),
            'sku' => strtoupper(Str::random(8)),
        ];
    }
}
