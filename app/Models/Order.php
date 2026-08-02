<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Order extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['user_id', 'order_number', 'status', 'coupon_id', 'subtotal_amount', 'discount_amount', 'shipping_fee', 'tax_amount', 'grand_total', 'shipping_address_id', 'billing_address_id', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted()
    {
        static::updated(function ($order) {
            if ($order->isDirty('status') && $order->status === 'delivered') {
                if ($order->user_id) {
                    $notes = json_decode($order->notes, true) ?? [];
                    if (!isset($notes['points_awarded'])) {
                        $loyaltyService = app(\App\Contracts\Loyalty\LoyaltyServiceInterface::class);
                        $loyaltyService->awardPoints($order->user_id, (float) $order->grand_total);
                        
                        $notes['points_awarded'] = true;
                        // Avoid triggering updated event again
                        static::withoutEvents(function () use ($order, $notes) {
                            $order->update(['notes' => json_encode($notes)]);
                        });
                    }
                }
            }
        });
    }
}
