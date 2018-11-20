<?php

use Faker\Generator as Faker;

$factory->define(App\Todolist::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true)
    ];
});
