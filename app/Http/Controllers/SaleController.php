<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store()
    {
        Sale::createAll(request()->all());
    }
}
