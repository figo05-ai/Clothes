<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory {
    protected $model = Order::class;
    public function definition() {
        return [
            'user_id' => User::factory(),
            'order_number' => strtoupper($this->faker->bothify('ORD-####-????')),
            'status' => 'pending',
            'coupon_id' => null,
            'subtotal_amount' => 100,
            'discount_amount' => 0,
            'shipping_fee' => 10,
            'tax_amount' => 5,
            'grand_total' => 115,
            'shipping_address_id' => null,
            'billing_address_id' => null,
            'notes' => null,
        ];
    }
}
