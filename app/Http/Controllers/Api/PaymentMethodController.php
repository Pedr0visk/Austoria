<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;


class PaymentMethodController extends Controller
{
    public function all()
    {
        return response()->json(Sale::$paymentMethods);
    }
}
