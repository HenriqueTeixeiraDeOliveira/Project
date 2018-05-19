<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

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
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Lesson::class, function (Faker $faker) {
    return [
        'subject_id' => 999,
        'professor_id' => 999,
        'title' => 'The Example Lesson',
        'subtitle' => 'This subtitle is just a example',
        'link' => 'https://www.youtube.com/embed/t_bOaAf_E0c'
    ];
});

$factory->state(App\Lesson::class, 'published', function ($faker) {
    return [
        'published_at' => Carbon::parse('-1 week')
    ];
});

$factory->state(App\Lesson::class, 'unpublished', function ($faker) {
    return [
        'published_at' => null
    ];
});
