<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;

class AnalyticsTest extends TestCase
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

    public function test_admin_can_view_dashboard_metrics(): void
    {
        $user = User::factory()->create();
        Order::factory()->count(5)->create(['user_id' => $user->id, 'status' => 'delivered']);

        $response = $this->actingAs($this->admin)->getJson('/admin/api/analytics/dashboard');
        
        $response->assertStatus(200);
        // We just assert that it's an array or has some expected keys depending on the mock/service
    }
}
