<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\SupportTicket;

class SupportTicketManagementTest extends TestCase
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

    public function test_admin_can_view_tickets(): void
    {
        $user = User::factory()->create();
        SupportTicket::create([
            'user_id' => $user->id,
            'ticket_number' => 'TCK-1',
            'subject' => 'Issue 1',
            'status' => 'open'
        ]);
        SupportTicket::create([
            'user_id' => $user->id,
            'ticket_number' => 'TCK-2',
            'subject' => 'Issue 2',
            'status' => 'open'
        ]);

        $response = $this->actingAs($this->admin)->getJson('/admin/api/support/tickets');
        
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
    }

    public function test_admin_can_update_ticket_status(): void
    {
        $user = User::factory()->create();
        $ticket = SupportTicket::create([
            'user_id' => $user->id,
            'ticket_number' => 'TCK-3',
            'subject' => 'Issue 3',
            'status' => 'open'
        ]);

        $response = $this->actingAs($this->admin)->putJson("/admin/api/support/tickets/{$ticket->id}/status", [
            'status' => 'closed'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('support_tickets', [
            'id' => $ticket->id,
            'status' => 'closed'
        ]);
    }

    public function test_admin_can_reply_to_ticket(): void
    {
        $user = User::factory()->create();
        $ticket = SupportTicket::create([
            'user_id' => $user->id,
            'ticket_number' => 'TCK-4',
            'subject' => 'Issue 4',
            'status' => 'open'
        ]);

        $response = $this->actingAs($this->admin)->postJson("/admin/api/support/tickets/{$ticket->id}/reply", [
            'message' => 'This is an admin response.'
        ]);

        $response->assertStatus(201);
        
        $this->assertDatabaseHas('ticket_replies', [
            'support_ticket_id' => $ticket->id,
            'message' => 'This is an admin response.',
            'is_admin_reply' => true
        ]);
    }
}
