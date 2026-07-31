<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // 1. Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // 2. Create Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$admin->roles()->where('id', $adminRole->id)->exists()) {
            $admin->roles()->attach($adminRole);
            
        }

        $customer = User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$customer->roles()->where('id', $customerRole->id)->exists()) {
            $customer->roles()->attach($customerRole);
        }

        // Use factory for extra users if it exists, otherwise just create them manually
        $users = collect();
        $users->push($customer);
        for ($u = 0; $u < 10; $u++) {
            $extraUser = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
            $extraUser->roles()->attach($customerRole);
            $users->push($extraUser);
        }

        // 3. Create Categories and Subcategories
        $categories = [
            'Men' => ['T-Shirts', 'Jeans', 'Jackets'],
            'Women' => ['Dresses', 'Tops', 'Skirts'],
            'Accessories' => ['Watches', 'Bags', 'Belts', 'Sunglasses'],
            'Shoes' => ['Sneakers', 'Boots', 'Formal', 'Sandals']
        ];

        $fashionImages = [
            'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=800&q=80',
            'https://images.unsplash.com/photo-1529139574466-a303027c028b?w=800&q=80',
            'https://images.unsplash.com/photo-1434389678232-04ce6fc8be28?w=800&q=80',
            'https://images.unsplash.com/photo-1617137968427-85924c800a22?w=800&q=80',
            'https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=800&q=80',
            'https://images.unsplash.com/photo-1539008835657-9e8e9680c956?w=800&q=80',
            'https://images.unsplash.com/photo-1596755094514-f87e32f85e2c?w=800&q=80',
            'https://images.unsplash.com/photo-1550614000-4b95d4662247?w=800&q=80',
            'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&q=80',
            'https://images.unsplash.com/photo-1618932260643-e65a04ce46cc?w=800&q=80',
            'https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=800&q=80',
            'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=800&q=80',
            'https://images.unsplash.com/photo-1550639525-c97d455acf70?w=800&q=80',
            'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=800&q=80',
            'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?w=800&q=80'
        ];

        foreach ($categories as $catName => $subCats) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'is_active' => true,
            ]);

            $subcategoryModels = [];
            foreach ($subCats as $subCatName) {
                $subcategoryModels[$subCatName] = Subcategory::create([
                    'category_id' => $category->id,
                    'name' => $subCatName,
                    'slug' => Str::slug($catName . '-' . $subCatName),
                    'is_active' => true,
                ]);
            }

            if (strtolower($catName) === 'men' || strtolower($catName) === 'women') {
                $folder = public_path('images/products/' . strtolower($catName));
                if (file_exists($folder)) {
                    $files = glob($folder . '/*.*');
                    foreach ($files as $file) {
                        if (is_dir($file)) continue;

                        $filename = basename($file);
                        $productName = pathinfo($filename, PATHINFO_FILENAME);
                        
                        // determine subcategory
                        $selectedSubcat = reset($subcategoryModels); // default to first subcategory
                        foreach ($subcategoryModels as $name => $model) {
                            if (stripos($productName, $name) !== false) {
                                $selectedSubcat = $model;
                                break;
                            }
                        }

                        $product = Product::create([
                            'subcategory_id' => $selectedSubcat->id,
                            'name' => ucwords($productName),
                            'slug' => Str::slug($productName) . '-' . uniqid(),
                            'sku' => strtoupper(uniqid('SKU-')),
                            'short_description' => $faker->sentence(10),
                            'long_description' => $faker->paragraphs(3, true),
                            'base_price' => $faker->randomFloat(2, 10, 300),
                            'stock_quantity' => rand(10, 100),
                            'status' => 'published',
                            'is_featured' => true,
                        ]);

                        // Add Main Image
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_path' => '/images/products/' . strtolower($catName) . '/' . $filename,
                            'is_primary' => true,
                            'sort_order' => 1
                        ]);

                        // Add Reviews randomly
                        if (rand(0, 1) == 1) {
                            $numReviews = rand(1, 3);
                            for ($r = 0; $r < $numReviews; $r++) {
                                ProductReview::create([
                                    'product_id' => $product->id,
                                    'user_id' => $users->random()->id,
                                    'rating' => rand(3, 5),
                                    'review_text' => $faker->sentence(15),
                                    'status' => 'approved'
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
