<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleItem;

class PaymentManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_payment_can_be_created()
    {
        $this->withoutExceptionHandling();

        $sale = factory(Sale::class)->create();

        $sale->items()->createMany([
            ['product_id' => 1, 'quantity' => 10, 'price' => 100, 'discount' => 0],
            ['product_id' => 2, 'quantity' => 5,  'price' => 150, 'discount' => 0],
        ]);

        $this->post('/payments', ['sale_id' => $sale->id]);

        $payments = Payment::all();

        $this->assertCount(1, $payments);

    }

    protected function sale()
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
