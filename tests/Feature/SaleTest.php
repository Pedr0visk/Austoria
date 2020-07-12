<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\SaleItem;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_sale_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();

        $response = $this->post('/api/sales', $this->data());

        $sale = Sale::first();
        $reponse = $this->delete($sale->path());

        $this->assertSoftDeleted('sales', ['id' => $sale->id]);

        $response->assertStatus(201);

    }

    protected function data()
    {
        return [
            'customer_id' => 1,
            'items'       => [
                ['product_id' => 1, 'quantity' => 10, 'price' => 100, 'discount' => 0],
                ['product_id' => 2, 'quantity' => 5,  'price' => 150, 'discount' => 0],
            ],
            'payment' => ['payment_method_id' => 1]
        ];
    }
}
