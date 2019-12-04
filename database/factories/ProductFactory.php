<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 300.50),
        'category_id' => 1
    ];
});
