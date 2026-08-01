<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ProductImage extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['product_id', 'image_path', 'sort_order', 'is_primary'];

    public function getImageUrlAttribute(): string
    {
        if (str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }
        
        $encodedPath = implode('/', array_map('rawurlencode', explode('/', ltrim($this->image_path, '/'))));
        return asset($encodedPath);
    }
}
