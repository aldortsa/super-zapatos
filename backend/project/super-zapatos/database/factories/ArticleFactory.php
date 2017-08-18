<?php
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'store_id' => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(App\Store::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
        'name'    => ucfirst($faker->unique()->sentence()),
        'description'  => $faker->text(100),
        'price' => (mt_rand(10, 1000) / 10),
        'total_in_shelf' => $faker->numberBetween(0,1000),
        'total_in_vault' => $faker->numberBetween(0,1000),
    ];
});