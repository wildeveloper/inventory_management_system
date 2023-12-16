<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $fillable = [
        'customer_name',
        'address',
        'phone',
        'product_id',
        'qty',
        'rate',
        'amount',
        'charge_amount',
        'vat_charge',
        'net_amount',
        'is_paid',
    ];
}
