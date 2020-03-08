<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'category_id' => rand(1, 5),
        'title' => $faker->realText(rand(40, 60)),
        'event_date' => $faker->date("Y-m-d"),
        'description' => $faker->realText(rand(1000, 2500)),
        'image' => rand(0, 1) ? 'img/news.jpg' : null,
        'is_private' => (boolean)rand(0, 1),
        'news_source' => '<a href="https://github.com/fzaninotto/Faker" class="nav-link">агенство Faker</a>'
    ];
});
