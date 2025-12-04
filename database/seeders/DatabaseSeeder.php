<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 test users
        User::factory(5)->create();

        // Create one test user
        // Avoid duplication if this seeder is run multiple times
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Seed categories
        $this->call(CategorySeeder::class);

        // Seed products with images
        $this->call(ProductSeeder::class);

        // Seed reviews
        $this->call(ReviewSeeder::class);
    }
}
