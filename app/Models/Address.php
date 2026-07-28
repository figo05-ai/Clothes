<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Address extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['user_id', 'type', 'first_name', 'last_name', 'address_line1', 'address_line2', 'city', 'state', 'postal_code', 'country', 'phone', 'is_default'];
}
