<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'instagram' => $faker->name,
        'dob' => date($format = 'Y-m-d')
    ];
});
