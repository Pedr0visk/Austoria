<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'customer_id' => factory(Customer::class),
        'items'       => [
            ['product_id' => 1, 'quantity' => 10, 'price' => 100, 'discount' => 0],
            ['product_id' => 2, 'quantity' => 5,  'price' => 150, 'discount' => 0],
        ],
    ];
});
