<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store()
    {
        Customer::create($this->validateRequest());
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
