<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_customer_can_be_created_from_api()
    {
        $this->post('/api/customers', $this->data());

        $customer = Customer::all();

        $this->assertCount(1, $customer);
        $this->assertInstanceOf(Carbon::class, $customer->first()->dob);
        $this->assertEquals('1997/31/08', $customer->first()->dob->format('Y/d/m'));
        $this->assertEquals('pedrobellotoficial', $customer->first()->instagram);
    }

    // /** @test */
    // public function customer_can_be_searched_from_api()
    // {
    //     $customer = $this->post('/api/customers', $this->data());

    //     $customers = $this->get('/api/customers/search?name=cus');

    //     $this->assertCount(1, $customers);
    // }

    private function data() {
        return [
            'name' => 'Customer name',
            'dob' => '1997-08-31',
            'instagram' => 'pedrobellotoficial',
            'phone' => '24998869574',
        ];
    }
}
