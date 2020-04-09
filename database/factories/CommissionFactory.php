<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commission;
use App\Package;
use Faker\Generator as Faker;

$factory->define(Commission::class, function (Faker $faker) {
    return [
        'type' => uniqid('FAKE COMMISSION TYPE '),
        'percentage_amount' => random_int(0, 100),
        'level' => random_int(0, 10),
        'package_id' => $faker->randomElement(Package::active()->get())->id,
        'status' => $faker->randomElement(array_column(Commission::$status, 'code'))
    ];
});
