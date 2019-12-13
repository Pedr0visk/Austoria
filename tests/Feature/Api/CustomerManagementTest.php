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
    public function customer_can_be_searched()
    {
        $this->withoutExceptionHandling();

        $this->post('/customers', $this->data());

        $customers = $this->get('/api/customers/search?name=cus');

        $this->assertCount(1, $customers);
    }

    private function data() {
        return [
            'name' => 'Customer name',
            'dob' => '31/08/1997',
            'phone' => '24998869574',
            'email' => 'pedro357bm@gmail.com',
        ];
    }
}
