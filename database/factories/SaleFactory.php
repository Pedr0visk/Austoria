<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'customer_id' => factory(Customer::class),
    ];
});

$factory->afterCreating(Sale::class, function ($sale, $faker) {
    factory(Product::class, 2)->create();

    $sale->items()->createMany(
        [
            ['product_id' => 1, 'quantity' => 10, 'price' => 100, 'discount' => 0],
            ['product_id' => 2, 'quantity' => 5,  'price' => 150, 'discount' => 0],
        ]
    );

    $sale->payment()->create(
        factory(Payment::class)->make(['sale_id' => $sale->id, 'amount' => $sale->total])->toArray()
    );
});


