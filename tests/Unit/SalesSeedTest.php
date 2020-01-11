<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use Carbon\Carbon;

class SalesSeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function seeding_fake_sales()
    {
        factory(Product::class, 25)->create();
        factory(Customer::class)->create();

        $customer = Customer::first();

        $years = [2019];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];


        foreach($years as $year) {

            $sale = [];

            foreach($months as $month) {
                // amount of sales
                for ($i=0; $i < rand(2, 10); $i++) {
                    // amount of products
                    for ($i=0; $i < rand(1, 5); $i++) {
                        $product = Product::find(rand(1, 10));
                        $sale['items'][] = [
                            'product_id'    => $product->id,
                            'price'         => $product->price,
                            'quantity'      => rand(1, 10),
                            'discount'      => rand(0, 20)
                        ];
                    }

                    $sale = array_merge($sale, ['customer_id' => 1]);

                    Sale::createAll($sale);
                }
            }
        }
        dd(Sale::all());

    }
}
