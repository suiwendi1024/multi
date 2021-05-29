<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => trim(substr($faker->sentence, 0, 40)),
        'body' => '<p>' . join('</p><p>', $faker->paragraphs) . '</p>',
        'cover_url' => $faker->imageUrl(800, 600),
        'summary' => trim(substr($faker->paragraph, 0, 200)),
        'views' => random_int(99, 9999),
    ];
});

// 多对一关联
$factory->state(Post::class, 'new', function () {
    return [
        'user_id' => factory(\App\User::class)->create(), // 省略“->id”
        'category_id' => factory(\App\Models\Category::class)->create(),
    ];
});

// 多对一关联User模型
$factory->state(Post::class, 'user', function () {
    return [
        'user_id' => factory(\App\User::class)->create(), // 省略“->id”
    ];
});

// 多对一关联Category模型
$factory->state(Post::class, 'category', function () {
    return [
        'category_id' => factory(\App\Models\Category::class)->create(),
    ];
});
