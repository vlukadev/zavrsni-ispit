<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        // Add other fields as needed
    ];

    // Add the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
