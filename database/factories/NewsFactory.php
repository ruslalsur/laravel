<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Factory;

$factory->define(News::class, function () {
    $faker = Factory::create('ru_RU');

    return [
        'category_id' => rand(1, 10),
        'title' => $faker->realText(rand(40, 60)),
        'event_date' => $faker->date("Y-m-d"),
        'description' => $faker->realText(rand(1000, 2500)),
        'image' => rand(0, 1) ? 'img/news.jpg' : null,
        'is_private' => (boolean)rand(0, 1)
    ];
});
