<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shipment;
use App\Models\Order;

class ShippingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_track_shipment(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $shipment = Shipment::create([
            'order_id' => $order->id,
            'tracking_number' => 'TRK123456',
            'carrier' => 'FedEx',
            'status' => 'shipped'
        ]);

        $response = $this->actingAs($user)->getJson('/api/shipping/track/TRK123456');

        $response->assertStatus(200);
        $response->assertJsonPath('data.tracking_number', 'TRK123456');
    }
}
