<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Wallet extends Model {
    use HasFactory, HasUlids;
    protected $fillable = ['user_id', 'balance'];
    public function user() { return $this->belongsTo(User::class); }
    public function transactions() { return $this->hasMany(WalletTransaction::class); }
}
