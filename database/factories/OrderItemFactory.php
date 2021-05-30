<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'quantity' => random_int(1, 5),
        'amount' => 0,
    ];
});

// 多对一关联
$factory->state(OrderItem::class, 'new', function () {
    return [
        'order_id' => factory(\App\Models\Order::class)->states('user')->create(), // 省略“->id”
        'product_id' => factory(\App\Models\Product::class)->states('category')->create(), // 省略“->id”
    ];
});

// 多对一关联Order模型
$factory->state(OrderItem::class, 'order', function () {
    return [
        'order_id' => factory(\App\Models\Order::class)->states('user')->create(), // 省略“->id”
    ];
});

// 多对一关联Product模型
$factory->state(OrderItem::class, 'product', function () {
    return [
        'product_id' => factory(\App\Models\Product::class)->states('category')->create(), // 省略“->id”
    ];
});

// 更新金额
$factory->afterCreating(OrderItem::class, function (OrderItem $orderItem, $faker) {
    // 更新小计
    $orderItem->increment('amount', $orderItem->product->price * $orderItem->quantity);
    // 更新总计
    $orderItem->order->increment('total', $orderItem->amount);
});