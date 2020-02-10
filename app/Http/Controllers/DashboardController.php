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
}
