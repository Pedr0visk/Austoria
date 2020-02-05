<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MetricsRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\SaleItem;
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
}
