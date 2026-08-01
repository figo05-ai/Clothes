<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductReview;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_product_reviews(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        ProductReview::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 5,
            'review_text' => 'Great product!',
            'status' => 'approved'
        ]);

        $response = $this->getJson("/api/products/{$product->id}/reviews");
        $response->assertStatus(200);
        // The endpoint is public usually but let's assert it returns data
        $response->assertJsonCount(1, 'data');
    }

    public function test_user_can_submit_review(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->postJson("/api/products/{$product->id}/reviews", [
            'rating' => 4,
            'review_text' => 'Pretty good.'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('product_reviews', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 4,
            'review_text' => 'Pretty good.'
        ]);
    }
}
