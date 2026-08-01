<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;

class OrderManagementTest extends TestCase
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

    public function test_admin_can_view_orders(): void
    {
        Order::factory()->count(2)->create();

        $response = $this->actingAs($this->admin)->getJson('/admin/api/orders');
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
    }

    public function test_admin_can_view_specific_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->actingAs($this->admin)->getJson("/admin/api/orders/{$order->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $order->id);
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($this->admin)->putJson("/admin/api/orders/{$order->id}/status", [
            'status' => 'shipped'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'shipped'
        ]);
    }
}
