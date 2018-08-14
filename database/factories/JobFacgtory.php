<?php

use Faker\Generator as Faker;

// First time using seeds and Faker.
// Great documentation at https://github.com/fzaninotto/Faker#fakerproviderlorem
$factory->define(App\Job::class, function (Faker $faker) {

    $cityIDs = DB::table('cities')->pluck('id');
    return [
        'city_id' => $faker->randomElement(DB::table('cities')->pluck('id')),
        'linkback' => str_random(10).'@example.com',
        'job_type_id' => $faker->randomElement(DB::table('job_types')->pluck('id')),
        'company' => str_random(10),
        'title' => str_random(),
        'description' => $faker->paragraph,
        'salary' => $faker->randomFloat(2, 10000, 500000),
    ];
});
