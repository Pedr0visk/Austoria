<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
    public function sale_can_be_soft_deleted()
    {
        $sale = factory(Sale::class)->create();

        // deleting sale
        $response = $this->delete($sale->path());

        $response->assertStatus(302);
        $this->assertCount(0, Sale::all());
        $this->assertCount(1, Sale::onlyTrashed()->get());
    }

    /** @test */
    public function a_deleted_sale_can_be_restored()
    {
        $this->withoutExceptionHandling();
        $sale = factory(Sale::class)->create();

        // deleting sale
        $this->delete($sale->path());
        $response = $this->get('/sales/restore/1');

        $response->assertStatus(302);
        $this->assertCount(1, Sale::all());
        $this->assertCount(0, Sale::onlyTrashed()->get());
    }

    /** @test */
    public function deleted_sales_can_be_listed()
    {
        $this->withoutExceptionHandling();
        $sales = factory(Sale::class, 4)->create();

        $response = $this->get('/sales');

        $response->assertStatus(200);

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
