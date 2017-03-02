<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Registros::class, function(Faker\Generator $faker){

    return [
        'nombre' => $faker->name,
        'primer_apellido' => $faker->lastName,
        'segundo_apellido' => $faker->lastName,
        'tipo_documento' => $faker->suffix,
        'numero_docuemnto' => $faker->isbn10,
        'fecha_nacimiento' => $faker->date(),
        'profesion' => $faker->jobTitle,
        'cargo' => $faker->catchPhrase,
        'empresa' => $faker->company,
        'telefono' => $faker->isbn10,
        'email' => $faker->email,
    ];
});