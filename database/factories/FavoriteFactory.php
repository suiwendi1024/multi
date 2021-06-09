<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Favorite;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        //
    ];
});

// 多对一关联User模型
$factory->state(Favorite::class, 'withUser', function () {
    return [
        'user_id' => factory(\App\User::class)->create(),
    ];
});

// 多对一关联Post模型
$factory->state(Favorite::class, 'withPost', function () {
    $post = factory(\App\Models\Post::class)->states('withUser', 'withCategory')->create();

    return [
        'favoritable_type' => $post->getMorphClass(),
        'favoritable_id' => $post,
    ];
});
