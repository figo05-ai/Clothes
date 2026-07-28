<?php
namespace App\Contracts\Wallet;
interface WalletServiceInterface {
    public function getBalance(string $userId): float;
    public function getTransactions(string $userId);
}
