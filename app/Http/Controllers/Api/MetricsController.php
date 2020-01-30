<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MetricsRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MetricsController extends Controller
{
    public function index(MetricsRepository $metrics, $year)
    {
        $data = $metrics->getAnnualSalesData($year);

        return response()->json($data);
    }
}
