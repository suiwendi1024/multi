<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Favorite;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        //
    ];
});

// 多对一关联
$factory->state(Favorite::class, 'new', function () {
    $post = factory(\App\Models\Post::class)->states('user', 'category')->create();

    return [
        'user_id' => factory(\App\User::class)->create(),
        'favoritable_type' => $post->getMorphClass(),
        'favoritable_id' => $post,
    ];
});

// 多对一关联User模型
$factory->state(Favorite::class, 'user', function () {
    return [
        'user_id' => factory(\App\User::class)->create(),
    ];
});

// 多对一关联Post模型
$factory->state(Favorite::class, 'post', function () {
    $post = factory(\App\Models\Post::class)->states('user', 'category')->create();

    return [
        'favoritable_type' => $post->getMorphClass(),
        'favoritable_id' => $post,
    ];
});
