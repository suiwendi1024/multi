<?php

use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        $posts = \App\Models\Post::latest('id')->limit(40)->get();
        $records = [];

        for ($i = 0; $i < $posts->count() * 20; $i++) {
            $favoritable = $posts->random();
            $value = [
                'user_id' => $users->random()->id,
                'favoritable_type' => $favoritable->getMorphClass(),
                'favoritable_id' => $favoritable->id,
            ];
            $records[join('-', $value)] = $value;
        }

        factory(\App\Models\Favorite::class)->createMany($records);
    }
}
