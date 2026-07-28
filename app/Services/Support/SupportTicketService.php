<?php
namespace App\Services\Support;
use App\Contracts\Support\SupportTicketServiceInterface;

class SupportTicketService implements SupportTicketServiceInterface {
    public function createTicket(string $userId, string $subject, string $message): array {
        return ['success' => true, 'ticket_id' => 'TKT-' . rand(1000, 9999)];
    }
}
