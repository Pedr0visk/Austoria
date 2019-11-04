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
        $this->assertEquals(1750.00, $sale->first()->subtotal);
        $this->assertEquals(1750.00, $sale->first()->total);
        $this->assertCount(2, SaleItem::all());
    }

    /** @test */
    public function a_sale_with_discount_can_be_created()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->post('/sales', array_merge($this->data(), ['discount' => 0.10]));

        $sales = Sale::all();

        $this->assertCount(1, $sales);
        $this->assertEquals(1750.00, $sales->first()->subtotal);
        $this->assertEquals(1575.00, $sales->first()->total);

     }

    /** @test */
    public function a_customer_id_is_required()
    {
        $response = $this->post('/sales', array_merge($this->data(), ['customer_id' => null]));

        $response->assertSessionHasErrors('customer_id');
    }

    /** @test */
    public function items_are_required()
    {
        $response = $this->post('/sales', array_merge($this->data(), ['items' => []]));

        $response->assertSessionHasErrors('items');
    }

    protected function data() 
    {
        return [
            'customer_id' => 1,
            'discount'    => null,
            'items'       => [
                ['product_id' => 1, 'quantity' => 10, 'price' => 100],
                ['product_id' => 2, 'quantity' => 5, 'price' => 150],
            ],
        ];
    }
}
