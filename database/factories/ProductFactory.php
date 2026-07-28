<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class ProductFactory extends Factory {
    protected $model = Product::class;
    public function definition() {
        $name = $this->faker->words(3, true);
        return [
            'subcategory_id' => Subcategory::factory(),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(4),
            'short_description' => $this->faker->sentence(),
            'long_description' => $this->faker->paragraph(),
            'base_price' => $this->faker->randomFloat(2, 10, 1000),
            'discount_price' => null,
            'sku' => strtoupper($this->faker->bothify('PROD-####-????')),
            'stock_quantity' => $this->faker->numberBetween(10, 100),
            'status' => 'published',
            'is_featured' => false,
        ];
    }
}
