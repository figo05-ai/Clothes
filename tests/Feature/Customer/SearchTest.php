<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_search_for_products(): void
    {
        Product::factory()->create(['name' => 'Blue Shirt', 'status' => 'published']);
        Product::factory()->create(['name' => 'Red Pants', 'status' => 'published']);

        $response = $this->getJson('/api/search?q=Blue');

        $response->assertStatus(200);
        // Depending on whether it's wrapped in 'data'
        $response->assertJsonFragment(['name' => 'Blue Shirt']);
        $response->assertJsonMissing(['name' => 'Red Pants']);
    }
}
