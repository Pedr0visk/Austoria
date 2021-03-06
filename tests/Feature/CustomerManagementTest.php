<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_customer_can_be_created()
    {
        $this->post('/customers', $this->data());

        $customer = Customer::all();

        $this->assertCount(1, $customer);
        $this->assertInstanceOf(Carbon::class, $customer->first()->dob);
        $this->assertEquals('1997/31/08', $customer->first()->dob->format('Y/d/m'));
        $this->assertEquals('pedrobelloto', $customer->first()->instagram);
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/customers', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_dob_is_required()
    {
        $response = $this->post('/customers', array_merge($this->data(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }

    /** @test */
    public function a_phone_is_required()
    {
        $response = $this->post('/customers', array_merge($this->data(), ['phone' => '']));

        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function a_customer_can_be_updated()
    {
        $response = $this->post('/customers', $this->data());

        $customer = Customer::first();

        $response = $this->patch($customer->path(), [
            'name' => 'Pedro',
            'dob' => '1995-12-09',
            'phone' => '21988970938',
        ]);

        $this->assertEquals('1995/12/09', $customer->fresh()->first()->dob->format('Y/m/d'));
    }

    private function data() {
        return [
            'name' => 'Customer name',
            'dob' => '1997-08-31',
            'phone' => '24998869574',
            'instagram' => 'pedrobelloto',
        ];
    }
}
