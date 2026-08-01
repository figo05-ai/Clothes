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
            'min_spend' => 50,
            'usage_limit' => 100,
            'used_count' => 0,
            'valid_from' => now(),
            'valid_until' => now()->addDays(30),
        ];
    }
}
