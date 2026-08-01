<?php
namespace App\Contracts\Wallet;
interface WalletServiceInterface {
    public function getBalance(string $userId): float;
    public function getTransactions(string $userId);
    public function isActive(string $userId): bool;
    public function toggleStatus(string $userId, bool $status): void;
    public function topUp(string $userId, float $amount, string $paymentMethod): void;
}
