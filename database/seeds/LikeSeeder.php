<?php

use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::ofType('user')->get();
        $posts = \App\Models\Post::latest('id')->limit(40)->get();
        $comments = \App\Models\Comment::latest('id')->limit(100)->get();
        $likeables = $posts->concat($comments);
        $records = [];

        for ($i = 0; $i < $likeables->count() * 20; $i++) {
            $likeable = $likeables->random();
            $value = [
                'user_id' => $users->random()->id,
                'likeable_type' => $likeable->getMorphClass(),
                'likeable_id' => $likeable->id,
            ];
            $records[join('-', $value)] = $value;
        }

        factory(\App\Models\Like::class)->createMany($records);
    }
}
