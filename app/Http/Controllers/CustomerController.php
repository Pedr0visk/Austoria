<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::query();

        if ($name = request()->name) {
            $customers->where('name', 'ILIKE', '%' . strtolower($name) . '%');
        }

        $customers = $customers->paginate();

        return view('customers.index')
            ->withCustomers($customers);
    }

    public function store()
    {
        Customer::create($this->validateRequest());

        return redirect(route('customers.index'));
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
