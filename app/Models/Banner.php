<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Banner extends Model {
    use HasFactory, HasUlids;
    protected $fillable = ['title', 'image_url', 'link_url', 'is_active', 'order'];
}
