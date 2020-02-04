<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store()
    {
        $sale = Sale::create($form = $this->validateRequest());

        $sale->items()->createMany($form['items']);

        $form['payment'] = array_merge($form['payment'], ['amount' => $sale->total]);

        $sale->payment()->create($form['payment']);

        return response()->json($sale, 201);
    }

    public function validateRequest()
    {
        return request()->validate([
            'customer_id' => 'required',
            'payment'     => 'required',
            'items'       => 'required|array|min:1'
        ]);
    }
}
