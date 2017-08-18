<?php
$factory->define(App\Store::class, function (Faker\Generator $faker) {
    return [
    	'name' => ucfirst(($faker->unique()->word).' Store'),
    	'Address' => $faker->text(100),
    ];
});