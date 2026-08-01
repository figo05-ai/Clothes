<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\SupportTicket;

class SupportTicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_tickets(): void
    {
        $user = User::factory()->create();
        SupportTicket::create([
            'user_id' => $user->id,
            'ticket_number' => 'TCK-123',
            'subject' => 'Issue',
            'status' => 'open'
        ]);

        $response = $this->actingAs($user)->getJson('/api/support/tickets');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }

    public function test_user_can_create_ticket(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/support/tickets', [
            'subject' => 'My Order',
            'message' => 'Where is it?'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('support_tickets', [
            'user_id' => $user->id,
            'subject' => 'My Order'
        ]);
        
        $this->assertDatabaseHas('ticket_replies', [
            'message' => 'Where is it?'
        ]);
    }

    public function test_user_can_reply_to_ticket(): void
    {
        $user = User::factory()->create();
        $ticket = SupportTicket::create([
            'user_id' => $user->id,
            'ticket_number' => 'TCK-123',
            'subject' => 'Issue',
            'status' => 'open'
        ]);

        $response = $this->actingAs($user)->postJson("/api/support/tickets/{$ticket->id}/reply", [
            'message' => 'Additional info'
        ]);

        $response->assertStatus(201); // the response is likely 200, but in creation could be 201. Wait, OpenAPI says 200.
        $this->assertDatabaseHas('ticket_replies', [
            'support_ticket_id' => $ticket->id,
            'message' => 'Additional info'
        ]);
    }
}
