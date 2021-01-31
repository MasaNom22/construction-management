<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class);
        },
        'name' => function() {
            return factory(User::class);
        },
        'comment' => $faker->text(10)
    ];
});
