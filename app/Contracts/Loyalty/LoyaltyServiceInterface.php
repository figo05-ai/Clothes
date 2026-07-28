<?php
namespace App\Contracts\Loyalty;
interface LoyaltyServiceInterface {
    public function awardPoints(string $userId, float $orderTotal): void;
    public function redeemPoints(string $userId, int $points): float;
    public function getBalance(string $userId): int;
}
