<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MetricsRepository;
use Illuminate\Http\Request;

class MetricsController extends Controller
{
    public function index(MetricsRepository $metrics)
    {
        $data = $metrics->getAnnualSalesData('2020');

        return response()->json($data);
    }
}
