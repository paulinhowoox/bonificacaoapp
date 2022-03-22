<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'user_id' => User::first(),
        'full_name' => $faker->name,
        'current_balance' => $faker->buildingNumber
    ];
});
