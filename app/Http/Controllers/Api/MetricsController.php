<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MetricsRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\SaleItem;
use App\Models\Payment;
use DB;

class MetricsController extends Controller
{
    public function sales(MetricsRepository $metrics, $year)
    {
        $data = $metrics->getAnnualSalesData($year);

        return response()->json($data);
    }

    public function saleItems(MetricsRepository $metrics)
    {
       $data = $metrics->getSaledItemsGroupByName();

        return response()->json($data);
    }

    public function payments($type)
    {
        $dataPayments = null;

        $date = Carbon::now();

        $query = DB::table('payments')
            ->select('payment_method_id', DB::raw('count(*) as total_payments'))
            ->groupBy('payment_method_id');

        if ($type === 'month') {
            $dataPayments = $query->whereMonth('created_at', $date->month)->get();
        } else {
            $dataPayments = $query->whereDate('created_at', $date)->get();
        }

        $methods = $dataPayments->map(function ($item) {
            switch ($item->payment_method_id) {
                case 1:
                    return 'Dinheiro';
                case 2:
                    return 'Débito';
                case 3:
                    return 'Crédito';
                default:
                    return  null;
            }
         });
        $payments = $dataPayments->map(function ($item) { return $item->total_payments; });

        $data = [
            'methods' => $methods,
            'payments' => $payments
        ];

        return response()->json($data);
    }
}
