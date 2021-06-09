<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        //
    ];
});

// 多对一关联Order模型
$factory->state(OrderItem::class, 'withOrder', function () {
    return [
        'order_id' => factory(\App\Models\Order::class)->states('withUser')->create(), // 省略“->id”
    ];
});

// 多对一关联Product模型
$factory->state(OrderItem::class, 'withProduct', function () {
    return [
        'product_id' => factory(\App\Models\Product::class)->states('withCategory')->create(), // 省略“->id”
    ];
});

// 更新金额
$factory->afterCreating(OrderItem::class, function (OrderItem $orderItem, $faker) {
    $orderItem->increment('amount', $orderItem->product->price * $orderItem->quantity);
    // 更新总计
    $orderItem->order->increment('total', $orderItem->amount);
});
