<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }

    public function store()
    {
        Customer::create($this->validateRequest());
    }

    public function update(Customer $customer)
    {
        $customer->update($this->validateRequest());
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
