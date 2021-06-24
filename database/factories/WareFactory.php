<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ware;
use Faker\Generator as Faker;

$factory->define(Ware::class, function (Faker $faker) {
    return [
        //
    ];
});

// 多对一关联Order模型
$factory->state(Ware::class, 'withOrder', function () {
    $order = factory(\App\Models\Order::class)->states('withUser')->create(); // 省略“->id”

    return [
        'subject_type' => $order->getMorphClass(),
        'subject_id' => $order,
    ];
});

// 多对一关联Product模型
$factory->state(Ware::class, 'withProduct', function () {
    return [
        'product_id' => factory(\App\Models\Product::class)->states('withCategory')->create(), // 省略“->id”
    ];
});

// 更新金额
$factory->afterCreating(Ware::class, function (Ware $ware, $faker) {
    $ware->increment('amount', $ware->product->price * $ware->quantity);
    // 更新总计
    $ware->subject->increment('total', $ware->amount);
});
