<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\Shipment;

class ShippingManagementTest extends TestCase
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

    public function test_admin_can_create_shipment(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($this->admin)->postJson('/admin/api/shipping', [
            'order_id' => $order->id,
            'tracking_number' => 'TRK-987654',
            'carrier' => 'DHL'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('shipments', [
            'order_id' => $order->id,
            'tracking_number' => 'TRK-987654',
            'carrier' => 'DHL'
        ]);
    }

    public function test_admin_can_update_shipment_status(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $shipment = Shipment::create([
            'order_id' => $order->id,
            'tracking_number' => 'TRK-111222',
            'carrier' => 'UPS',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($this->admin)->putJson("/admin/api/shipping/{$shipment->tracking_number}/status", [
            'status' => 'delivered'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('shipments', [
            'tracking_number' => 'TRK-111222',
            'status' => 'delivered'
        ]);
    }
}
