<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::ofType('user')->latest('id')->limit(10)->get();
        $records = [];
        $date = '-6 months';


        for ($i = 0; $i < $users->count() * 20; $i++) {
            $records[] = [
                'user_id' => $users->random()->id,
                'created_at' => $date = app(\Faker\Generator::class)->dateTimeInInterval($date, '+20 hours'),
            ];
        }
        factory(\App\Models\Order::class)->createMany($records);
    }
}
