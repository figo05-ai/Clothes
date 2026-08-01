<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\LoyaltyAccount;

class LoyaltyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_loyalty_balance(): void
    {
        $user = User::factory()->create();
        $account = LoyaltyAccount::create([
            'user_id' => $user->id,
            'points' => 500,
            'lifetime_points' => 1000,
            'tier' => 'gold'
        ]);

        $response = $this->actingAs($user)->getJson('/api/loyalty/balance');
        $response->assertStatus(200);
        $response->assertJsonFragment(['points' => 500]);
    }

    public function test_user_can_redeem_points(): void
    {
        $user = User::factory()->create();
        $account = LoyaltyAccount::create([
            'user_id' => $user->id,
            'points' => 500,
            'lifetime_points' => 1000,
            'tier' => 'gold'
        ]);

        $response = $this->actingAs($user)->postJson('/api/loyalty/redeem', [
            'points' => 100
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('loyalty_accounts', [
            'user_id' => $user->id,
            'points' => 400
        ]);
    }
}
