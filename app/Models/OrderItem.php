<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class OrderItem extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['order_id', 'product_id', 'variant_id', 'name', 'quantity', 'unit_price', 'total_price'];
}
