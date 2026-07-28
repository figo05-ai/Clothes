<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TicketReply extends Model {
    use HasFactory, HasUlids;
    protected $fillable = ['support_ticket_id', 'user_id', 'message', 'is_admin_reply'];
    public function ticket() { return $this->belongsTo(SupportTicket::class, 'support_ticket_id'); }
    public function user() { return $this->belongsTo(User::class); }
}
