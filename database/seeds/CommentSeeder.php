<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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
        $records = [];

        for ($i = 0; $i < $posts->count() * 20; $i++) {
            $records[] = [
                'user_id' => $users->random()->id,
                'commentable_type' => $posts[0]->getMorphClass(),
                'commentable_id' => $posts->random()->id,
            ];
        }

        factory(\App\Models\Comment::class)->createMany($records);
    }
}
