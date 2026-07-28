<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
