<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer:id,name')->with('items')->paginate(3);

        return view('sales.index')
            ->withSales($sales);
    }

    public function create()
    {
        return view('sales.create');
    }

    public function show(Sale $sale)
    {
        return view('sales.show')
            ->withSale($sale);
    }

    public function search()
    {
        $sales = Sale::query()->with('customer:id,name');

        if ($start_date = request()->start_date) {
            $sales->whereDate('sales.created_at', '>=', $start_date);
        }

        if ($end_date = request()->end_date) {
            $sales->whereDate('sales.created_at', '<=', $end_date);
        }

        if ($total = request()->total) {
            $sales->whereExists(function ($query) use ($total) {
                $query->select(DB::raw(1))
                    ->from('sale_items')
                    ->whereRaw('sale_items.sale_id = sales.id')
                    ->havingRaw('SUM(quantity * price) <= ?', [intval($total)]);
            });
        }

        $sales = $sales->paginate();

        return view('sales.search')->withSales($sales);
    }
}
