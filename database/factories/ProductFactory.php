<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'cover_url' => $faker->imageUrl(800, 800),
        'name' => $faker->sentence,
        'price' => random_int(9, 99999) / 100,
        'description' => '<p>' . join('</p><p>', $faker->paragraphs) . '</p>',
        'stock' => 999,
    ];
});

// 多对一关联Category模型
$factory->state(Product::class, 'withCategory', function () {
    return [
        'category_id' => factory(\App\Models\Category::class)->create(['type' => 'product']),
    ];
});
