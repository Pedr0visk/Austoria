<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class MetricsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
}
