<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ReturnRequest extends Model {
    use HasFactory, HasUlids;
    protected $fillable = ['order_id', 'user_id', 'reason', 'details', 'status'];
    public function order() { return $this->belongsTo(Order::class); }
    public function user() { return $this->belongsTo(User::class); }
}
