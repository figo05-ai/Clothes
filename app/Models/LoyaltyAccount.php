<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LoyaltyAccount extends Model {
    use HasFactory, HasUlids;
    protected $fillable = ['user_id', 'points'];
    public function user() { return $this->belongsTo(User::class); }
}
