<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class UserPreference extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['user_id', 'preferred_top_size', 'preferred_bottom_size', 'style_preference', 'shoe_size', 'enable_recommendations'];
}
