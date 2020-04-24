<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Medidor::class, function (Faker $faker) {
    return [
        //
        'codigo'=>$faker->str_random(10),
        'numero'=>$faker->int_random(100),
        
        'persona_id' => factory(App\Persona::class)
    ];
});
