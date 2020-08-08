<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'sale_id' => 1,
        'payment_method_id' => 1,
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 100),
    ];
});
