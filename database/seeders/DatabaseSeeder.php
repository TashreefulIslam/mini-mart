<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
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
        // Create default admin
        User::factory()->create([
            'name' => 'Mini-Mart Admin',
            'email' => 'admin@minimart.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Create sample categories
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Living',
            'Beauty',
            'Grocery',
            'Accessories',
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat, 'description' => $cat . ' products']);
        }

        // Create a few sample products
        $electronics = Category::where('name', 'Electronics')->first();

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Wireless Headphones',
            'description' => 'Comfortable wireless headphones with long battery life.',
            'price' => 2500,
            'quantity' => 10,
            'image_url' => 'https://images.unsplash.com/photo-1518444023500-24f3f69b3f3b',
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Smart Watch',
            'description' => 'Stylish smart watch with fitness tracking.',
            'price' => 4200,
            'quantity' => 8,
            'image_url' => 'https://images.unsplash.com/photo-1516728778615-2d590ea1856f',
        ]);
    }
}
