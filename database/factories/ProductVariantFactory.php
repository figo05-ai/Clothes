<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantFactory extends Factory {
    protected $model = ProductVariant::class;
    public function definition() {
        return [
            'product_id' => Product::factory(),
            'sku' => strtoupper($this->faker->bothify('VAR-####-????')),
            'price_adjustment' => 0,
            'attributes' => ['color' => 'Red', 'size' => 'M'],
            'inventory_quantity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
