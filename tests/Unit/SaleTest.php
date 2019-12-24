<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sale;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store_sale_with_discount()
    {
        Sale::createAll($this->data());

        $sales = Sale::all();

        $this->assertCount(1, $sales);
    }

    protected function data()
    {
        return [
            'customer_id' => 1,

            'items'       => [
                ['product_id' => 1, 'quantity' => 10, 'discount' => 10, 'price' => 100],
                ['product_id' => 2, 'quantity' => 5, 'discount' => 10, 'price' => 150],
            ],
        ];
    }
}
