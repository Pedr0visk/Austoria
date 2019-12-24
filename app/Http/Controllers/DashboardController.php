<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\SaleItem;
use App\Models\Sale;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        $catService = Category::where('name', 'service')->first();
        $catProduct = Category::where('name', 'product')->first();

        $today = Carbon::now();
        $month = $today->month;

        $monthSales = Sale::whereMonth('created_at', $month)
            ->with('items')
            ->get();

        $sales = Sale::whereDate('created_at', $today)
            ->with('customer:id,name')
            ->with('items')
            ->get();


        $salesAmount = $sales->map(function ($sale) {
            return $sale->total;
        })->sum();

        $monthSalesAmount = $monthSales->map(function ($sale) {
            return $sale->total;
        })->sum();

        return view('dashboard.index')
            ->withSales($sales)
            ->withMonthSalesAmount($monthSalesAmount)
            ->withSalesAmount($salesAmount);
    }

    public function old()
    {
        $catService = Category::where('name', 'service')->first();
        $catProduct = Category::where('name', 'product')->first();

        // daily
        $today = Carbon::now();

        $saleItems = SaleItem::whereDate('created_at', $today)
        ->with('product')
        ->get();

        $serviceAmount = SaleItem::whereDate('created_at', $today)
            ->whereHas('product', function (Builder $query) use ($catService) {
                $query->where('category_id', $catService->id);
            })
            ->count();

        $productAmount = SaleItem::whereDate('created_at', $today)
            ->whereHas('product', function (Builder $query) use ($catProduct) {
                $query->where('category_id', $catProduct->id);
            })
            ->count();

        return $productAmount;

        $sales = SaleItem::select(DB::raw('sum(sale_items.price * sale_items.quantity) as total'))
            ->whereDate('created_at', $today)
            ->groupBy('sale_id')->get();

        $dailyAmount = collect($saleItems)->map(function ($item) {
            return $item->totalAmount;
        })->sum();

        return view('dashboard.index')
            ->withDailyAmount($dailyAmount)
            ->withSales($sales)
            ->withSaleItems($saleItems)
            ->withSalesAmount($salesAmount);
    }
}
