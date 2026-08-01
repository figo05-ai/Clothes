<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\ProductReview;
use App\Models\Product;

class ReviewManagementTest extends TestCase
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

    public function test_admin_can_view_pending_reviews(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        ProductReview::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 4,
            'review_text' => 'Good',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($this->admin)->getJson('/admin/api/reviews/pending');
        
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }

    public function test_admin_can_update_review_status(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $review = ProductReview::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 4,
            'review_text' => 'Good',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($this->admin)->putJson("/admin/api/reviews/{$review->id}/status", [
            'status' => 'approved'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('product_reviews', [
            'id' => $review->id,
            'status' => 'approved'
        ]);
    }
}
