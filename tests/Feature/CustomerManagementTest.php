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
        $this->withoutExceptionHandling();
        $response = $this->post('/customers', $this->data());

        $customer = Customer::all();

        $this->assertCount(1, $customer);
        $this->assertInstanceOf(Carbon::class, $customer->first()->dob);
        $this->assertEquals('1997/31/08', $customer->first()->dob->format('Y/d/m'));
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
        $this->withoutExceptionHandling();

        $response = $this->post('/customers', $this->data());

        $customer = Customer::first();

        $response = $this->patch($customer->path(), [
            'name' => 'Pedro',
            'dob' => '09/12/1995',
            'phone' => '21988970938',
            'email' => 'pbelloto@gmail.com',
        ]);

        $this->assertEquals('1995/12/09', $customer->first()->dob->format('Y/d/m'));


        $this->post('/books', $this->data());


        $response = $this->patch($book->path(), [
            'title' => 'New Title',
            'author_id' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals(2, Book::first()->author_id);
        $response->assertRedirect($book->fresh()->path());
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
