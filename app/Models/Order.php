<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Order extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['user_id', 'order_number', 'status', 'coupon_id', 'subtotal_amount', 'discount_amount', 'shipping_fee', 'tax_amount', 'grand_total', 'shipping_address_id', 'billing_address_id', 'notes'];
}
