<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'total' => 0,
    ];
});

// 多对一关联
$factory->state(Order::class, 'new', function () {
    return [
        'user_id' => factory(\App\User::class)->create(), // 省略“->id”
    ];
});

// 多对一关联User模型
$factory->state(Order::class, 'user', function () {
    return [
        'user_id' => factory(\App\User::class)->create(), // 省略“->id”
    ];
});
