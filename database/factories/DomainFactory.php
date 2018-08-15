<?php

use Faker\Generator as Faker;

$factory->define(App\Domain::class, function (Faker $faker) {
    return [
        'campaign_id' => $faker->numberBetween(1,5),
        'name' => $faker->unique()->name,
    ];
});
