<?php

use Faker\Generator as Faker;

$factory->define(App\JobSkill::class, function (Faker $faker) {
    return [
        'job_id' => $faker->randomElement(DB::table('jobs')->pluck('id')),
        'skill' => $faker->randomElement(['php', 'linux', 'javascript', 'css', 'html', 'python', 'java', 'angular', 'react']),
    ];
});
