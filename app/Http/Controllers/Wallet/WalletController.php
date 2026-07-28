<?php
namespace App\Http\Controllers\Wallet;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Wallet\WalletServiceInterface;
use App\Http\Resources\Wallet\WalletTransactionResource;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller {
    public function __construct(protected WalletServiceInterface $walletService) {}
    #[OA\Post(
        path: '/api/wallet/balance',
        summary: 'balance operation',
        tags: ['Customer - Wallet'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function balance() {
        $balance = $this->walletService->getBalance(Auth::id() ?? 'guest-id');
        return response()->json(['balance' => $balance]);
    }
    #[OA\Post(
        path: '/api/wallet/transactions',
        summary: 'transactions operation',
        tags: ['Customer - Wallet'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function transactions() {
        $transactions = $this->walletService->getTransactions(Auth::id() ?? 'guest-id');
        return WalletTransactionResource::collection($transactions);
    }
}
