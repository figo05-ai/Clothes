<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Transaction extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['order_id', 'transaction_id', 'payment_method', 'amount', 'status', 'payment_response'];
}
