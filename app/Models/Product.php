<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $withCount = [
        'visits'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
