<?php

namespace App\Models;

use DB;
use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['customer_id', 'discount'];
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public static function createAll($input_form)
    {
        DB::transaction(function () use ($input_form) {

            $items = collect($input_form['items'])->map(function ($item) {
                return new SaleItem($item);
            });

            $sale = self::create($input_form);
            $sale->items()->saveMany($items);
        });
    }

    public function getTotalAttribute() 
    {
        $total = $this->items->map(function ($item) {
            return $item->subtotal;
        });

        return $total->sum();
    }
}
