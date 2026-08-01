<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Coupon;

class CouponManagementTest extends TestCase
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

    public function test_admin_can_view_coupons(): void
    {
        Coupon::factory()->count(2)->create();

        $response = $this->actingAs($this->admin)->getJson('/admin/api/coupons');
        
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
    }

    public function test_admin_can_create_coupon(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/api/coupons', [
            'code' => 'HOLIDAY20',
            'type' => 'percentage',
            'value' => 20,
            'usage_limit' => 100,
            'valid_until' => now()->addDays(10)->toDateTimeString()
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('coupons', [
            'code' => 'HOLIDAY20',
            'value' => 20
        ]);
    }

    public function test_admin_can_delete_coupon(): void
    {
        $coupon = Coupon::factory()->create();

        $response = $this->actingAs($this->admin)->deleteJson("/admin/api/coupons/{$coupon->id}");

        $response->assertStatus(200); // Controller returns 200 ['success' => true]
        $this->assertDatabaseMissing('coupons', [
            'id' => $coupon->id
        ]);
    }
}
