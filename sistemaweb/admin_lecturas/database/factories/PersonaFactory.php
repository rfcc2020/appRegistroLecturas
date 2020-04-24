<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Persona::class, function (Faker $faker) {
    return [
        //
        'cedula'=>$faker->str_random(10),
        'nombre'=>$faker->firstName,
        'apellido'=>$faker->lastName,
        'telefono'=>$faker->phoneNumber,
        'email'=>$faker->unique()->safeEmail,
        'estado'=>$faker->randomElement(['A', 'X']),
        'sector'=>$faker->randomElement(['Portete', 'Pedregal','La Union','Rayo Loma']),
    ];
});
