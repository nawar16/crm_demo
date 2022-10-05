<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Salary;
use Faker\Generator as Faker;

$factory->define(Salary::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::first()->id,
        'basic_salary' => 5000,
        'month' => $faker->randomNumber(1)
    ];
});

