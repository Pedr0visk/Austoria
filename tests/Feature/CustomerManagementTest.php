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
        $response = $this->post('/customers', $this->data());

        $customer = Customer::all();

        $this->assertCount(1, $customer);
        $this->assertInstanceOf(Carbon::class, $customer->first()->dob);
        $this->assertEquals('1997/14/05', $customer->first()->dob->format('Y/d/m'));
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

    private function data() {
        return [
            'name' => 'Cusomer name',
            'dob' => '05/14/1997',
            'phone' => '24998869574',
            'email' => 'pedro357bm@gmail.com',
        ];
    }
}
