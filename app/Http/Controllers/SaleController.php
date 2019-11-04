<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store()
    {
        Sale::createAll($this->validateRequest());
    }

    public function validateRequest()
    {
        return request()->validate([
            'customer_id' => 'required',
            'discount'    => 'nullable',
            'items'       => 'required|array|min:1'
        ]);
    }
}
