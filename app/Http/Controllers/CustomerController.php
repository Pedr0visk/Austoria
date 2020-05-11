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

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Customer $customer)
    {
        $customer->update($this->validateRequest());

        return redirect(route('customers.index'))
            ->with('success', 'Cliente (' . $customer->name . ') atualizado com sucesso');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Cliente deletado com sucesso');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'name'      => 'required',
            'dob'       => 'required',
            'phone'     => 'required',
            'instagram'     => 'nullable',
        ]);
    }
}
