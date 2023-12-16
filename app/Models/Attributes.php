<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;

    public function attribute_values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

    protected $fillable = [
        'name',
        'is_active',
    ];
}
