<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commission;
use App\Package;
use Faker\Generator as Faker;

$factory->define(Package::class, function (Faker $faker) {
    return [
        'name' => uniqid('FAKE PACK '), 
        'description' => $faker->paragraph, 
        'amount' => random_int(0, 1000), 
        'allowed_children' => random_int(0, 10), 
        'status' => $faker->randomElement(array_column(Package::$status, 'code'))
    ];
});

//attach some commission types to packages
$factory->afterCreating(Package::class, function ($package, $faker) {
    factory(Commission::class, $faker->randomElement([1, 2, 3, 4]))->create([
        'package_id' => $package->id
    ]);
});
