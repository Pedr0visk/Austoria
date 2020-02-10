<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Sale;

class PaymentMethodsCompose
{
    public function compose(View $view)
    {
        $view->with('paymentMethods', Sale::$paymentMethods);
    }
}
