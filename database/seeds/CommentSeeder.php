<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * @var \App\User[]|\Illuminate\Database\Eloquent\Collection
     */
    protected $users;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Models\Post::latest('id')->limit(40)->get();
        $products = \App\Models\Product::latest('id')->limit(40)->get();

        $this->createManyComments($posts);
        $this->createManyComments($products);
    }

    /**
     * 创建一些评论。
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $commentables
     */
    protected function createManyComments(\Illuminate\Database\Eloquent\Collection $commentables)
    {
        $users = $this->getUsers();
        $records = [];

        for ($i = 0; $i < $commentables->count() * 20; $i++) {
            $records[] = [
                'user_id' => $users->random()->id,
                'commentable_type' => $commentables[0]->getMorphClass(),
                'commentable_id' => $commentables->random()->id,
            ];
        }

        factory(\App\Models\Comment::class)->createMany($records);
    }

    /**
     * 获取一批用户。
     *
     * @return \App\User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUsers()
    {
        if (empty($this->users)) {
            $this->users = \App\User::ofType('user')->get();
        }
        return $this->users;
    }
}
