<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'product_id',
        'price',
        'quantity',
        'discount',
    ];

    protected $guarded = [];

    public function getSubtotalAmountAttribute()
    {
        return $this->attributes['price'] * $this->attributes['quantity'];
    }

    public function getTotalAmountAttribute()
    {
        $total = $this->subtotalAmount;
        $total -= $total * ($this->discount/100);

        return round($total, 2);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
