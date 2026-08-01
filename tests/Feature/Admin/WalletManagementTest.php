<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Wallet;

class WalletManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $this->admin->roles()->attach($role);
    }

    public function test_admin_can_add_wallet_credit(): void
    {
        $user = User::factory()->create();
        Wallet::create(['user_id' => $user->id, 'balance' => 0]);

        $response = $this->actingAs($this->admin)->postJson('/admin/api/wallet/credit', [
            'user_id' => $user->id,
            'amount' => 500,
            'description' => 'Refund for order'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('wallets', [
            'user_id' => $user->id,
            'balance' => 500
        ]);

        $wallet = Wallet::where('user_id', $user->id)->first();
        
        $this->assertDatabaseHas('wallet_transactions', [
            'wallet_id' => $wallet->id,
            'amount' => 500,
            'type' => 'credit'
        ]);
    }
}
