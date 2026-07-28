<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Coupon;

class CouponFactory extends Factory {
    protected $model = Coupon::class;
    public function definition() {
        return [
            'code' => strtoupper($this->faker->bothify('DISCOUNT##')),
            'type' => 'percentage',
            'value' => 10,
            'min_order_amount' => 50,
            'max_discount_amount' => 100,
            'usage_limit' => 100,
            'used_count' => 0,
            'starts_at' => now(),
            'expires_at' => now()->addDays(30),
            'is_active' => true,
        ];
    }
}
