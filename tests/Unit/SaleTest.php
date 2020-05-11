<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Payment;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function sale_create_method()
    {
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();

        $items[] = [
            'product_id'    => 1,
            'price'         => floatval($products->first()->price),
            'quantity'      => rand(1, 5),
            'discount'      => rand(0, 20)
        ];

        $items[] = [
            'product_id'    => 2,
            'price'         => floatval($products->first()->price),
            'quantity'      => rand(1, 5),
            'discount'      => rand(0, 20)
        ];

        $form = [
            'customer_id' => $customer->id,
            'payment' => ['payment_method_id' => 1]
        ];


        $form['items'] = $items;
        $form['created_at'] = Carbon::createFromFormat('Y-m-d', '2019-02-20');

        $sale = Sale::create($form);

        $sale->items()->createMany($form['items']);

        $form['payment'] = array_merge($form['payment'], ['amount' => $sale->total]);

        $sale->payment()->create($form['payment']);

        $this->assertCount(1, Sale::all());
        $this->assertCount(1, Payment::all());
        $this->assertCount(2, SaleItem::all());
        $this->assertEquals('2019/02/20', Sale::first()->created_at->format('Y/m/d'));
    }
}
