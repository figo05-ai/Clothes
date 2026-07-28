<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Post extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['author_id', 'title', 'slug', 'content', 'featured_image', 'status', 'published_at'];
}
