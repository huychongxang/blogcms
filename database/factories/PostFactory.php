<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;

$factory->define(Model::class, function (Faker $faker) {
    $image = "Post_Image_" . rand(1, 5) . "jpg";
    return [
        'user_id' => rand(1, 3),
        'title' => $faker->title,
        'excerpt' => $faker->text(rand(250, 300)),
        'body' => $faker->paragraphs,
        'slug' => $faker->slug,
        'image' => $image
    ];
});
