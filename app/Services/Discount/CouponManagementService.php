<?php
namespace App\Services\Discount;

use App\Contracts\Discount\CouponManagementServiceInterface;
use App\Models\Coupon;

class CouponManagementService implements CouponManagementServiceInterface {
    public function getAllCoupons() {
        return Coupon::all();
    }
    public function createCoupon(array $data) {
        return Coupon::create($data);
    }
    public function deleteCoupon(string $id): void {
        Coupon::findOrFail($id)->delete();
    }
}
