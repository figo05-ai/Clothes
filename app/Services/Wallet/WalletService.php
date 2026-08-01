<?php
namespace App\Services\Wallet;
use App\Contracts\Wallet\WalletServiceInterface;
use App\Contracts\Wallet\AdminWalletServiceInterface;
use App\Models\Wallet;

class WalletService implements WalletServiceInterface, AdminWalletServiceInterface {
    protected function getWallet(string $userId) {
        return Wallet::firstOrCreate(['user_id' => $userId]);
    }
    public function getBalance(string $userId): float {
        return (float) $this->getWallet($userId)->balance;
    }
    public function getTransactions(string $userId) {
        return $this->getWallet($userId)->transactions()->orderBy('created_at', 'desc')->get();
    }
    public function addCredit(string $userId, float $amount, string $description): void {
        $wallet = $this->getWallet($userId);
        $wallet->balance += $amount;
        $wallet->save();
        $wallet->transactions()->create(['type' => 'credit', 'amount' => $amount, 'description' => $description]);
    }
    public function deductCredit(string $userId, float $amount, string $description): void {
        $wallet = $this->getWallet($userId);
        $wallet->balance -= $amount;
        $wallet->save();
        $wallet->transactions()->create(['type' => 'debit', 'amount' => $amount, 'description' => $description]);
    }
    
    public function isActive(string $userId): bool {
        return (bool) $this->getWallet($userId)->is_active;
    }
    
    public function toggleStatus(string $userId, bool $status): void {
        $wallet = $this->getWallet($userId);
        $wallet->is_active = $status;
        $wallet->save();
    }
    
    public function topUp(string $userId, float $amount, string $paymentMethod): void {
        // In a real app, this would verify the payment was successful with Stripe/PayPal before adding credit.
        // For now, we mock the success.
        $this->addCredit($userId, $amount, "Self-Service Top-Up via " . ucfirst($paymentMethod));
    }
}
