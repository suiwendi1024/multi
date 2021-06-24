<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        //
    ];
});

// 多对一关联User模型
$factory->state(Like::class, 'withUser', function () {
    return [
        'user_id' => factory(\App\User::class)->create(),
    ];
});

// 多对一关联Post模型
$factory->state(Like::class, 'withPost', function () {
    $post = factory(\App\Models\Post::class)->states('withUser', 'withCategory')->create();

    return [
        'likeable_type' => $post->getMorphClass(),
        'likeable_id' => $post,
    ];
});

// 多对一关联Comment模型
$factory->state(Like::class, 'withComment', function () {
    $comment = factory(\App\Models\Comment::class)->states('withUser', 'withPost')->create();

    return [
        'likeable_type' => $comment->getMorphClass(),
        'likeable_id' => $comment,
    ];
});
