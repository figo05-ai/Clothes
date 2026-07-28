<?php
namespace App\Contracts\Wallet;
interface AdminWalletServiceInterface {
    public function addCredit(string $userId, float $amount, string $description): void;
    public function deductCredit(string $userId, float $amount, string $description): void;
}
