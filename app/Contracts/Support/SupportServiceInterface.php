<?php
namespace App\Contracts\Support;
interface SupportServiceInterface {
    public function getUserTickets(string $userId);
    public function createTicket(string $userId, array $data);
    public function replyToTicket(string $ticketId, string $userId, array $data, bool $isAdmin = false);
}
