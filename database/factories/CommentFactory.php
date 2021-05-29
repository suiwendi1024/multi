<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
    ];
});

// 多对一关联
$factory->state(Comment::class, 'new', function () {
    $post = factory(\App\Models\Post::class)->states('user', 'category')->create();

    return [
        'user_id' => factory(\App\User::class)->create(),
        'commentable_type' => $post->getMorphClass(),
        'commentable_id' => $post,
    ];
});

// 多对一关联User模型
$factory->state(Comment::class, 'user', function () {
    return [
        'user_id' => factory(\App\User::class)->create(),
    ];
});

// 多对一关联Post模型
$factory->state(Comment::class, 'post', function () {
    $post = factory(\App\Models\Post::class)->states('user', 'category')->create();

    return [
        'commentable_type' => $post->getMorphClass(),
        'commentable_id' => $post,
    ];
});
