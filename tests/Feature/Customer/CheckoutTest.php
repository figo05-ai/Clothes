<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Address;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_checkout(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['base_price' => 100, 'stock_quantity' => 10]);
        // Add to cart
        $this->actingAs($user)->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        // Checkout
        $response = $this->actingAs($user)->postJson('/api/checkout', [
            'shipping_address' => '123 Main St, New York, NY 10001',
            'billing_address' => '123 Main St, New York, NY 10001',
            'payment_method' => 'credit_card',
            'shipping_cost' => 10,
            'tax_amount' => 5
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
        ]);
        
        $order = \App\Models\Order::where('user_id', $user->id)->first();
        
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);
    }
}
