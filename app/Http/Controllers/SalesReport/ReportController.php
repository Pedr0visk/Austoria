<?php

namespace App\Http\Controllers\SalesReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function index()
    {
        $years = [2019,2018,2017];
        $data = [180, 200, 230, 200, 260, 280, 300, 320, 340, 320, 380, 500];

        return view('reports.index', compact(['data', 'years']));
        // return $sales = Sale::whereYear('created_at', '2018')
        //      ->where(DB::raw('extract(MONTH from "created_at")'), '01')
        //     //  ->whereMonth('created_at', '01')
        //      ->get();
    }

    public function show($date)
    {
        $datetime = Carbon::create($date);

        $year = $datetime->year;
        $month = $datetime->month;

        $sales = Sale::whereYear('created_at', $year)
             ->where(DB::raw('extract(MONTH from "created_at")'), $month);

        $sales = $sales->paginate(15);

        return view('reports.show')->withSales($sales);
    }
}
