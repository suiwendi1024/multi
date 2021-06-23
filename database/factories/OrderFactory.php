<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        //
    ];
});

// 多对一关联User模型
$factory->state(Order::class, 'withUser', function () {
    return [
        'user_id' => factory(\App\User::class)->create(), // 省略“->id”
    ];
});
