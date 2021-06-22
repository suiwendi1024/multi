<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::whereType('user')->latest('id')->limit(10)->get();
        $categories = \App\Models\Category::whereType('post')->ofGeneration(2)->get();
        $records = [];

        for ($i = 0; $i < $users->count() * 20; $i++) {
            $records[] = [
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ];
        }

        factory(\App\Models\Post::class)->createMany($records);
    }
}
