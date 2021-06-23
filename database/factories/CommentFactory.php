<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
    ];
});

// 多对一关联User模型
$factory->state(Comment::class, 'withUser', function () {
    return [
        'user_id' => factory(\App\User::class)->create(),
    ];
});

// 多对一关联Post模型
$factory->state(Comment::class, 'withPost', function () {
    $post = factory(\App\Models\Post::class)->states('withUser', 'withCategory')->create();

    return [
        'commentable_type' => $post->getMorphClass(),
        'commentable_id' => $post,
    ];
});
