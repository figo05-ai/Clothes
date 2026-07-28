<?php
namespace App\Services\Loyalty;
use App\Contracts\Loyalty\LoyaltyServiceInterface;
use App\Models\LoyaltyAccount;

class LoyaltyPointsService implements LoyaltyServiceInterface {
    protected function getAccount(string $userId) {
        return LoyaltyAccount::firstOrCreate(['user_id' => $userId]);
    }
    public function awardPoints(string $userId, float $orderTotal): void {
        $pointsToAward = (int) floor($orderTotal / 10); // 1 point per $10
        $account = $this->getAccount($userId);
        $account->points += $pointsToAward;
        $account->save();
    }
    public function redeemPoints(string $userId, int $points): float {
        $account = $this->getAccount($userId);
        if ($account->points >= $points) {
            $account->points -= $points;
            $account->save();
            return (float) ($points / 100); // 100 points = $1 discount
        }
        return 0.0;
    }
    public function getBalance(string $userId): int {
        return $this->getAccount($userId)->points;
    }
}
