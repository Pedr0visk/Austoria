<?php

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Customer;
use Carbon\Carbon;


class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years = [2019, 2018, 2017];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $customer = Customer::first();

        foreach($years as $year) {

            foreach($months as $month) {
                # amount of sales
                for ($i=0; $i < rand(20, 50) ; $i++) {
                    $form = [];
                    $items = [];

                    # amount of products
                    for ($j=0; $j < rand(1, 3); $j++) {
                        $product = Product::find(rand(1,2));

                        $items[] = [
                            'product_id'    => $product->id,
                            'price'         => floatval($product->price),
                            'quantity'      => rand(1, 5),
                            'discount'      => rand(0, 20)
                        ];
                    }

                    $form['customer_id'] = $customer->id;
                    $form['items'] = $items;
                    $form['payment'] = ['payment_method_id' => rand(1, 3)];
                    $form['created_at'] = date('Y-m-d', strtotime($year. '-' . $month . '-' . random_int(1, 29)));

                    $sale = Sale::create(['customer_id' => $customer->id]);

                    $sale->items()->createMany($form['items']);

                    $form['payment'] = array_merge($form['payment'], ['amount' => $sale->total]);

                    $sale->payment()->create($form['payment']);
                }

            }
        }
    }
}
