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
        ['id' => 2, 'name' => 'Débito'],
        ['id' => 3, 'name' => 'Crédito'],
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

        return round($subtotal->sum(), 2);
    }

    public function getTotalAttribute()
    {
        $total = $this->items->map(function ($item) {
            return $item->totalAmount;
        });

        return round($total->sum(), 2);
    }

}
