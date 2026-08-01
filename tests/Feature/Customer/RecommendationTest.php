<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class RecommendationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_recommendations(): void
    {
        Product::factory()->count(3)->create(['status' => 'published']);

        $response = $this->getJson('/api/recommendations');

        $response->assertStatus(200);
        // The implementation probably returns random products or popular ones
        $response->assertJsonStructure(['data' => [['id', 'name', 'price']]]);
    }
}
