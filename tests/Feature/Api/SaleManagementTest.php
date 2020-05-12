<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\SaleItem;

class SaleManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_sale_can_be_created()
    {
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();

        $response = $this->post('/api/sales', $this->data());

        $sale = Sale::all();
        $payment = Payment::all();

        $this->assertCount(1, $sale);
        $this->assertCount(1, $payment);
        $this->assertEquals(1750.00, $payment->first()->amount);
        $this->assertEquals(1750.00, $sale->first()->subtotal);
        $this->assertEquals(1750.00, $sale->first()->total);
        $this->assertCount(2, SaleItem::all());
        $this->assertCount(1, Sale::all());
    }

    /** @test */
    public function a_credit_transaction_can_be_created()
    {
        $this->withoutExceptionHandling();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();

        $data = array_merge ($this->data(), [
            'payment' => ['payment_method_id' => 3]
        ]);

        $response = $this->post('/api/sales', $data);

        $sale = Sale::all();
        $payment = Payment::all();

        $this->assertCount(1, $sale);
        $this->assertCount(1, $payment);
        $this->assertEquals(1662.675, $payment->first()->amount);
        $this->assertCount(2, SaleItem::all());
        $this->assertCount(1, Sale::all());

    }

    /** @test */
    public function a_debit_transaction_can_be_created()
    {
        $this->withoutExceptionHandling();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();

        $data = array_merge ($this->data(), [
            'payment' => ['payment_method_id' => 2]
        ]);

        $response = $this->post('/api/sales', $data);

        $sale = Sale::all();
        $payment = Payment::all();

        $this->assertCount(1, $sale);
        $this->assertCount(1, $payment);
        $this->assertEquals(1708.175, $payment->first()->amount);
        $this->assertCount(2, SaleItem::all());
        $this->assertCount(1, Sale::all());

    }

    /** @test */
    public function a_sale_with_discount_can_be_created()
    {
        $this->withoutExceptionHandling();

        $data = array_merge (
            $this->data(),
            [
                'items' => [
                    ['product_id' => 1, 'quantity' => 10, 'price' => 100, 'discount' => 10],
                    ['product_id' => 2, 'quantity' => 5,  'price' => 150, 'discount' => 0],
                ]
            ]
        );

        $response = $this->post('/api/sales', $data);

        $sales = Sale::all();
        $payment = Payment::all();

        $this->assertCount(1, $sales);
        $this->assertEquals(1750.00, $sales->first()->subtotal);
        $this->assertEquals(1650.00, $sales->first()->total);
        $this->assertEquals(1650.00, $payment->first()->amount);
     }

    /** @test */
    public function a_customer_id_is_required()
    {
        $response = $this->post('/api/sales', array_merge($this->data(), ['customer_id' => null]));

        $response->assertSessionHasErrors('customer_id');
    }

    /** @test */
    public function items_are_required()
    {
        $response = $this->post('/api/sales', array_merge($this->data(), ['items' => []]));

        $response->assertSessionHasErrors('items');
    }

    /** @test */
    public function payment_is_required()
    {
        $response = $this->post('/api/sales', array_merge($this->data(), ['payment' => []]));

        $response->assertSessionHasErrors('payment');
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
