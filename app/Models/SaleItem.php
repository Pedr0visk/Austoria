<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'product_id',
        'price',
        'quantity',
    ];

    protected $guarded = [];

    public function getTotalAmountAttribute()
    {
        return $this->attributes['price'] * $this->attributes['quantity'];
    }
}
