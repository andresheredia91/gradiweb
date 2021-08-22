<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Vehiculo::class, function (Faker $faker) {
    return [
        'placa' => $faker->regexify('[A-Z]{3}').''.$faker->regexify('[0-9]{3}'),
        'marca_id' => $faker->numberBetween(1, 10),
        'tipo_id' => $faker->numberBetween(1, 4),
        'user_id' => $faker->numberBetween(1, 50),
    ];
});
