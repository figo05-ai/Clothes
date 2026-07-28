<?php
namespace App\Contracts\Support;
interface AdminSupportServiceInterface {
    public function getAllTickets();
    public function updateTicketStatus(string $ticketId, string $status);
}
