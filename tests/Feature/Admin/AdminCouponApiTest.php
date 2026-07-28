<?php
namespace Tests\Feature\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminCouponApiTest extends TestCase {
    use RefreshDatabase;

    public function test_admin_can_create_coupon() {
        $admin = User::factory()->create();
        
        $payload = [
            'code' => 'SUMMER50',
            'type' => 'percentage',
            'value' => 50,
            'min_order_amount' => 100,
            'usage_limit' => 100,
            'starts_at' => now()->toDateTimeString(),
            'expires_at' => now()->addDays(10)->toDateTimeString(),
            'is_active' => true
        ];

        $response = $this->actingAs($admin)->postJson('/admin/api/coupons', $payload);
        $response->assertStatus(201);
        $this->assertDatabaseHas('coupons', ['code' => 'SUMMER50']);
    }
}
