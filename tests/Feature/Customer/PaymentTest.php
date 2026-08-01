<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_generate_payment_link(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id, 'grand_total' => 100]);

        $response = $this->actingAs($user)->postJson("/api/payments/{$order->id}/generate");

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['payment_url']]);
    }

    public function test_payment_webhook_can_be_processed(): void
    {
        $response = $this->postJson('/api/payments/webhook', [
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => 'cs_test_123'
                ]
            ]
        ], [
            'Stripe-Signature' => 'test_signature'
        ]);

        $response->assertStatus(200);
    }
}
