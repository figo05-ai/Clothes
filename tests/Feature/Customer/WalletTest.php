<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_wallet_balance(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::create(['user_id' => $user->id, 'balance' => 250.00, 'currency' => 'USD']);

        $response = $this->actingAs($user)->getJson('/api/wallet/balance');
        $response->assertStatus(200);
        $response->assertJsonFragment(['balance' => 250.00]);
    }

    public function test_user_can_view_wallet_transactions(): void
    {
        $user = User::factory()->create();
        $wallet = Wallet::create(['user_id' => $user->id, 'balance' => 250.00, 'currency' => 'USD']);
        WalletTransaction::create([
            'wallet_id' => $wallet->id, 
            'amount' => 100.00,
            'type' => 'credit',
            'description' => 'Test',
            'status' => 'completed',
            'reference_id' => 'REF123'
        ]);

        $response = $this->actingAs($user)->getJson('/api/wallet/transactions');
        $response->assertStatus(200);
    }
}
