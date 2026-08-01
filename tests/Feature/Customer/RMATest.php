<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\ReturnRequest;

class RMATest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_returns(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        
        ReturnRequest::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'reason' => 'Defective item',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($user)->getJson('/api/returns');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }

    public function test_user_can_submit_return_request(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->postJson('/api/returns', [
            'order_id' => $order->id,
            'reason' => 'Defective',
            'details' => 'The item is torn.'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('return_requests', [
            'user_id' => $user->id,
            'order_id' => $order->id,
            'reason' => 'Defective'
        ]);
    }
}
