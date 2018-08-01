<?php

use Faker\Generator as Faker;
use JansenFelipe\FakerBR\FakerBR;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $faker->addProvider(new FakerBR($faker));

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'cpf'            => $faker->unique()->cpf,
        'birthdate'      => $faker->date('Y-m-d'),
        'image'          => $faker->imageUrl(200, 200, null, true),
        'status'         => 1,
        'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
