<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class CatalogApiTest extends TestCase {
    use RefreshDatabase;

    public function test_can_get_categories() {
        Category::factory()->count(3)->create();
        $response = $this->getJson('/api/categories');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'name', 'slug']]]);
    }

    public function test_can_get_products() {
        Product::factory()->count(5)->create();
        $response = $this->getJson('/api/products');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'name', 'price']]]); // ProductResource maps base_price to price usually?
    }

    public function test_can_get_single_product() {
        $product = Product::factory()->create();
        $response = $this->getJson('/api/products/' . $product->id);
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $product->id);
    }
}
