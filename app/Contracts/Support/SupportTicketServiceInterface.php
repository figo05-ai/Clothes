<?php
namespace App\Contracts\Support;

interface SupportTicketServiceInterface {
    public function createTicket(string $userId, string $subject, string $message): array;
}
