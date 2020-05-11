<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_method_id',
        'amount',
        'created_at',
    ];

    public function getPaymentMethodAttribute()
    {
        return collect(Sale::$paymentMethods)->filter(function ($paymentMethod) {
            return $paymentMethod['id'] == $this->payment_method_id;
        });
    }

    public function getPayMethodNameAttribute()
    {
        $payMethod = collect(Sale::$paymentMethods)->filter(function ($paymentMethod) {
            return $paymentMethod['id'] == $this->payment_method_id;
        })->first();

        return $payMethod['name'];
    }
}
