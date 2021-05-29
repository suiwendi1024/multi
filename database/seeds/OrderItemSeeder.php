<?php

use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = \App\Models\Order::all();
        $products = \App\Models\Product::all();
        $records = [];

        for ($i = 0; $i < $orders->count() * 5; $i++) {
            $records[] = [
                'order_id' => $orders->random()->id,
                'product_id' => $products->random()->id,
            ];
        }

        factory(\App\Models\OrderItem::class)->createMany($records);
    }
}
