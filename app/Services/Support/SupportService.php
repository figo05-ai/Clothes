<?php
namespace App\Services\Support;
use App\Contracts\Support\SupportServiceInterface;
use App\Contracts\Support\AdminSupportServiceInterface;
use App\Models\SupportTicket;

class SupportService implements SupportServiceInterface, AdminSupportServiceInterface {
    public function getUserTickets(string $userId) {
        return SupportTicket::with('replies')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }
    public function createTicket(string $userId, array $data) {
        $ticket = SupportTicket::create([
            'user_id' => $userId,
            'subject' => $data['subject'],
            'status' => 'open'
        ]);
        $ticket->replies()->create([
            'user_id' => $userId,
            'message' => $data['message'],
            'is_admin_reply' => false
        ]);
        return $ticket;
    }
    public function replyToTicket(string $ticketId, string $userId, array $data, bool $isAdmin = false) {
        $ticket = SupportTicket::findOrFail($ticketId);
        $reply = $ticket->replies()->create([
            'user_id' => $userId,
            'message' => $data['message'],
            'is_admin_reply' => $isAdmin
        ]);
        if ($isAdmin && $ticket->status === 'open') {
            $ticket->status = 'in_progress';
            $ticket->save();
        }
        return $reply;
    }
    public function getAllTickets() {
        return SupportTicket::with('user', 'replies')->orderBy('created_at', 'desc')->get();
    }
    public function updateTicketStatus(string $ticketId, string $status) {
        $ticket = SupportTicket::findOrFail($ticketId);
        $ticket->status = $status;
        $ticket->save();
        return $ticket;
    }
}
