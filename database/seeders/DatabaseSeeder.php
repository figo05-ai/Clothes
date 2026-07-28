<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Men' => ['T-Shirts', 'Jeans', 'Jackets'],
            'Women' => ['Dresses', 'Tops', 'Skirts'],
            'Kids' => ['Boys', 'Girls', 'Infants']
        ];

        foreach ($categories as $catName => $subCats) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'is_active' => true,
            ]);

            foreach ($subCats as $subCatName) {
                $subcategory = Subcategory::create([
                    'category_id' => $category->id,
                    'name' => $subCatName,
                    'slug' => Str::slug($catName . '-' . $subCatName),
                    'is_active' => true,
                ]);

                // Create 4 products for each subcategory
                for ($i = 1; $i <= 4; $i++) {
                    Product::create([
                        'subcategory_id' => $subcategory->id,
                        'name' => "Stylish $subCatName Item $i",
                        'slug' => Str::slug("Stylish $subCatName Item $i") . '-' . uniqid(),
                        'sku' => strtoupper(uniqid('SKU-')),
                        'short_description' => 'A wonderful item for your collection.',
                        'long_description' => 'This item is made of high quality materials and designed to last.',
                        'base_price' => rand(20, 150) + 0.99,
                        'stock_quantity' => rand(10, 100),
                        'status' => 'published',
                        'is_featured' => rand(0, 1) == 1,
                    ]);
                }
            }
        }
    }
}
