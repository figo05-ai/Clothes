<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WalletTransaction extends Model {
    use HasFactory, HasUlids;
    protected $fillable = ['wallet_id', 'type', 'amount', 'description'];
    public function wallet() { return $this->belongsTo(Wallet::class); }
}
