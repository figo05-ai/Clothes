<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Contracts\Wallet\WalletServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletPageController extends Controller
{
    public function __construct(protected WalletServiceInterface $walletService)
    {
    }

    public function index()
    {
        $userId = Auth::id();
        $balance = $this->walletService->getBalance($userId);
        $transactions = $this->walletService->getTransactions($userId);
        $isActive = $this->walletService->isActive($userId);

        return view('frontend.wallet', compact('balance', 'transactions', 'isActive'));
    }

    public function topUp(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:5|max:10000',
            'payment_method' => 'required|string|in:credit_card,paypal'
        ]);

        try {
            $this->walletService->topUp(Auth::id(), $request->amount, $request->payment_method);
            return redirect()->back()->with('success', 'Wallet topped up successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to top up wallet: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request)
    {
        $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $this->walletService->toggleStatus(Auth::id(), $request->is_active);
        
        $statusMessage = $request->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Wallet $statusMessage successfully.");
    }
}
