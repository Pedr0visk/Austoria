<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        return view('sales');
    }

    public function create()
    {
        return view('sales.create');
    }

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
