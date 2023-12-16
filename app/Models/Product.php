<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    protected $fillable = [
        'name',
        'sku',
        'price',
        'qty',
        'desc',
        'brand_id',
        'category_id',
        'store_id',
        'is_active',
    ];
}
