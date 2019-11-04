<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleItem;

class SaleManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_sale_can_be_created()
    {
        $this->withoutExceptionHandling();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();
        
        $response = $this->post('/sales', $this->data());

        $sale = Sale::all();

        $this->assertCount(1, $sale);
        $this->assertEquals(1750.00, $sale->first()->total);

        $this->assertCount(2, SaleItem::all());
        $this->assertCount(2, Product::all());
        $this->assertCount(1, Customer::all());
        dd(Sale::first()->total);
    }

    protected function data() 
    {
        return [
            'customer_id' => 1,
            'discount' => 0.1,
            'items'       => [
                ['product_id' => 1, 'quantity' => 10, 'price' => 100],
                ['product_id' => 2, 'quantity' => 5, 'price' => 150],
            ],
        ];
    }
}
