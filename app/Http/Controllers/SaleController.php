<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::paginate(15);

        return view('sales.index')
            ->withSales($sales);
    }

    public function create()
    {
        return view('sales.create');
    }
}
