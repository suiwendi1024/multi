<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        //
    ];
});

// 多对一关联
$factory->state(Like::class, 'new', function () {
    $post = factory(\App\Models\Post::class)->states('user', 'category')->create();

    return [
        'user_id' => factory(\App\User::class)->create(),
        'likeable_type' => $post->getMorphClass(),
        'likeable_id' => $post,
    ];
});

// 多对一关联User模型
$factory->state(Like::class, 'user', function () {
    return [
        'user_id' => factory(\App\User::class)->create(),
    ];
});

// 多对一关联Post模型
$factory->state(Like::class, 'post', function () {
    $post = factory(\App\Models\Post::class)->states('user', 'category')->create();

    return [
        'likeable_type' => $post->getMorphClass(),
        'likeable_id' => $post,
    ];
});

// 多对一关联Comment模型
$factory->state(Like::class, 'comment', function () {
    $comment = factory(\App\Models\Comment::class)->states('user', 'post')->create();

    return [
        'likeable_type' => $comment->getMorphClass(),
        'likeable_id' => $comment,
    ];
});
