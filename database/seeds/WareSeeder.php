<?php

use Illuminate\Database\Seeder;

class WareSeeder extends Seeder
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
            /** @var \App\Models\Product $product */
            $product = $products->random();
            $quantity = random_int(1, 5);

            $records[] = [
                'subject_type' => $orders[0]->getMorphClass(),
                'subject_id' => $orders->random()->id,
                'product_id' => $product->id,
                'amount' => $product->price * $quantity,
                'quantity' => $quantity,
            ];
        }

        factory(\App\Models\Ware::class)->createMany($records);
    }
}
