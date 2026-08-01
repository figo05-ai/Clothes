<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Coupon;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_apply_coupon(): void
    {
        $user = User::factory()->create();
        $coupon = Coupon::factory()->create(['code' => 'SAVE10']);

        $response = $this->actingAs($user)->postJson('/api/coupons/apply', [
            'code' => 'SAVE10'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    public function test_user_can_remove_coupon(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/coupons/remove');

        $response->assertStatus(200);
    }
}
