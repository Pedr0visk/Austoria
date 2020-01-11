<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store()
    {
        $sale = Sale::createAll($this->validateRequest());

        return response()->json($sale, 201);
    }

    public function validateRequest()
    {
        return request()->validate([
            'customer_id' => 'required',
            'items'       => 'required|array|min:1'
        ]);
    }
}
