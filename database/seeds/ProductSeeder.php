<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::whereType('user')->latest('id')->limit(10)->get();
        $categories = \App\Models\Category::whereType('product')->ofGeneration(2)->get();
        $records = [];

        for ($i = 0; $i < $users->count() * 20; $i++) {
            $records[] = [
                'category_id' => $categories->random()->id,
            ];
        }


        factory(\App\Models\Product::class)->createMany($records);
    }
}
