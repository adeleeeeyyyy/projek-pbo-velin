<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator ATK',
            'email' => 'admin@atk.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Regular User
        User::create([
            'name' => 'Budi Pelanggan',
            'email' => 'user@atk.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Categories
        $categories = [
            'Buku Tulis',
            'Alat Tulis Dasar',
            'Peralatan Kantor',
            'Kertas & Karton',
        ];

        foreach ($categories as $catName) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);

            // Add some products to each category
            for ($i = 1; $i <= 4; $i++) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $catName . ' Item ' . $i,
                    'slug' => Str::slug($catName . ' Item ' . $i . '-' . rand(100, 999)),
                    'sku' => strtoupper(substr($catName, 0, 3)) . '-' . rand(1000, 9999),
                    'description' => 'Ini adalah deskripsi produk berkualitas tinggi untuk ' . $catName . '. Sangat awet dan harga terjangkau.',
                    'price' => rand(5000, 50000),
                    'stock' => rand(10, 100),
                    'images' => [], // Empty images for now
                ]);
            }
        }
    }
}
