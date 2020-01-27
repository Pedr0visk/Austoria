<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\MetricsRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(MetricsRepository $metrics)
    {
        $totalAmount = $metrics->getCurrentMonthAmount();
        $dailyAmount = $metrics->dailyAmount();

        return view('dashboard.index', compact(['dailyAmount', 'totalAmount']));
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
