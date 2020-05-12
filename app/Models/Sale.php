<?php

namespace App\Models;

use DB;
use App\Models\SaleItem;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['customer_id', 'cashier_id'];

    // soon stored in database
    public static $paymentMethods = [
        ['id' => 1, 'name' => 'Dinheiro'],
        ['id' => 2, 'name' => 'Débito', 'tax' => 2.39],
        ['id' => 3, 'name' => 'Crédito', 'tax' => 4.99],
    ];

    public static $rules = ['customer_id' => 'required'];

    public function path()
    {
        return '/sales/' . $this->id;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getSubtotalAttribute()
    {
        $subtotal = $this->items->map(function ($item) {
            return $item->subtotalAmount;
        });

        return $subtotal->sum();
    }

    public function getTotalAttribute()
    {
        $total = $this->items->map(function ($item) {
            return $item->totalAmount;
        });

        return $total->sum();
    }

}
