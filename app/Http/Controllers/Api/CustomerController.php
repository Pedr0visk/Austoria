<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function search()
    {
        $customers = Customer::query();

        if ($name = request()->name) {
            $customers->where('name', 'ILIKE', '%' . strtolower($name) . '%');
        }

        $customers = $customers->get();

        return response()->json($customers);
    }

    public function store()
    {
        $customer = Customer::create($this->validateRequest());

        return response()->json($customer);
    }

    protected function validateRequest()
    {
        return request()->validate([
            'name'      => 'required',
            'dob'       => 'required',
            'phone'     => 'required',
            'email'     => 'nullable',
        ]);
    }
}
