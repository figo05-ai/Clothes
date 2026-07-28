<?php
namespace App\Contracts\Discount;

interface CouponManagementServiceInterface {
    public function getAllCoupons();
    public function createCoupon(array $data);
    public function deleteCoupon(string $id): void;
}
