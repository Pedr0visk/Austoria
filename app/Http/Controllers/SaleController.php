<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class SaleController extends Controller
{
    public function index()
    {
        $currentMonth = new Carbon();

        $paymentMethods = Sale::$paymentMethods;

        $sales = Sale::with('customer:id,name')
             ->with('items')
             ->whereMonth('created_at', $currentMonth)
             ->where('deleted_at', null)
             ->orderBy('created_at', 'desc')
             ->paginate();

        return view('sales.index', compact(['sales', 'paymentMethods']));
    }

    public function trash()
    {
        $paymentMethods = Sale::$paymentMethods;

        $sales = Sale::with('customer:id,name')
             ->onlyTrashed()
             ->paginate();

        return view('sales.trash', compact(['sales', 'paymentMethods']));
    }

    public function restore(Request $request)
    {
        $sale = Sale::withTrashed()->find($request->saleId)->restore();

        return redirect()->route('sales.trash');
    }

    public function delete(Request $request)
    {
        $sale = Sale::withTrashed()->find($request->saleId)->forceDelete();

        return redirect()->route('sales.trash');
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

        if ($payment_method = request()->payment_method) {
            $sales->join('payments', 'payments.sale_id', '=', 'sales.id')
                ->where('payments.payment_method_id', $payment_method);
        }

        if ($total = request()->total) {
            $sales->whereExists(function ($query) use ($total) {
                $query->select(DB::raw(1))
                    ->from('sale_items')
                    ->whereRaw('sale_items.sale_id = sales.id')
                    ->havingRaw('SUM(quantity * price) <= ?', [intval($total)]);
            });
        }

        $saleTotalAmount = collect($sales->get())->map(function ($sale) {
            return $sale->total;
        })->sum();


        $sales = $sales->paginate();
        return view('sales.search')
             ->withSales($sales)
             ->withTotalAmount($saleTotalAmount);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index');
    }
}
