<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UploadImage;
use Faker\Generator as Faker;

$factory->define(UploadImage::class, function (Faker $faker) {
    return [
        'file_name' => $faker->text(10),
        'file_path' => $faker->text(10),
        'title' => $faker->text(5),
        'content' => $faker->text(5),
        'user_id' => function () {
            return factory(User::class);
        },
    ];
});
