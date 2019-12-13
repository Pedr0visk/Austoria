<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;
use App\Models\Sale;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
        // daily
        $sales = SaleItem::select(DB::raw('sum(sale_items.price * sale_items.quantity) as total'))
            ->whereDate('created_at', '2019-12-13')
            ->groupBy('sale_id')->get();

        $dailyAmount = collect($sales)->map(function ($sale) {
            return $sale->total;
        })->sum();


        // total
        $salesAll = SaleItem::select(DB::raw('sum(sale_items.price * sale_items.quantity) as total'))
            ->groupBy('sale_id')->get();

        $totalAmount = collect($salesAll)->map(function ($sale) {
            return $sale->total;
        })->sum();

        return $salesAll;
    }
}
