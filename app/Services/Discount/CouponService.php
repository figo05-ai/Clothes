<?php

namespace App\Services\Discount;

use App\Contracts\Discount\DiscountServiceInterface;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CouponService implements DiscountServiceInterface
{
    protected string $sessionKey = 'applied_coupon';

    public function applyCoupon(string $code): array
    {
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return ['success' => false, 'message' => 'Invalid coupon code.'];
        }

        if (!$coupon->is_active) {
            return ['success' => false, 'message' => 'This coupon is no longer active.'];
        }

        if ($coupon->expires_at && Carbon::now()->greaterThan($coupon->expires_at)) {
            return ['success' => false, 'message' => 'This coupon has expired.'];
        }

        if ($coupon->usage_limit && $coupon->usage_count >= $coupon->usage_limit) {
            return ['success' => false, 'message' => 'This coupon usage limit has been reached.'];
        }

        // Store coupon in session
        Session::put($this->sessionKey, [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount_type' => $coupon->discount_type, // 'percentage' or 'fixed'
            'discount_value' => $coupon->discount_value,
        ]);

        return ['success' => true, 'message' => 'Coupon applied successfully.'];
    }

    public function removeCoupon(): array
    {
        Session::forget($this->sessionKey);
        return ['success' => true, 'message' => 'Coupon removed.'];
    }

    public function calculateTotal(float $subtotal): float
    {
        $coupon = Session::get($this->sessionKey);

        if (!$coupon) {
            return $subtotal;
        }

        if ($coupon['discount_type'] === 'percentage') {
            $discountAmount = ($subtotal * $coupon['discount_value']) / 100;
            return max(0, $subtotal - $discountAmount);
        }

        if ($coupon['discount_type'] === 'fixed') {
            return max(0, $subtotal - $coupon['discount_value']);
        }

        return $subtotal;
    }
}
