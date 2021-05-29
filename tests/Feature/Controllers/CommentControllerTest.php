<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $post = factory(\App\Models\Post::class)->state('new')->create();
        $comments = factory(\App\Models\Comment::class, 2)->state('user')->create([
            'commentable_type' => $post->getMorphClass(),
            'commentable_id' => $post->id,
        ]);
        $con = $this->getConnection();

        $con->enableQueryLog(); // 开启查询记录

        // 逆序
        $this->getJson(route('posts.comments.index', ['post' => 1]))->assertSeeInOrder([
            $comments[1]->body,
            $comments[0]->body,
        ]);

        $con->disableQueryLog(); // 关闭查询记录

        // 没有重复查询
        $queries = array_column($con->getQueryLog(), 'query');

        $this->assertSameSize(array_unique($queries), $queries);
    }

    public function testStore()
    {
        $comment = factory(\App\Models\Comment::class)->state('new')->make(['id' => 1]);

        // 未登录
        $this->postStore()->assertUnauthorized();

        $this->actingAs($comment->user); // 登录

        // 数据不合法
        $this->postStore()->assertJsonValidationErrors('body');

        // 数据合法
        $this->postStore($comment->toArray())->assertJsonFragment(['body' => $comment->body]);
    }

    /**
     * @param  array  $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postStore(array $data = [])
    {
        return $this->postJson(route('posts.comments.store', ['post' => 1]), $data);
    }

    public function testDestroy()
    {
        $comment = factory(\App\Models\Comment::class)->state('new')->create();

        // 未登录
        $this->deleteDestroy()->assertUnauthorized();

        // 未授权
        $this->actingAs(factory(\App\User::class)->create());
        $this->deleteDestroy()->assertForbidden();

        // 授权
        $this->actingAs($comment->user);
        $this->deleteDestroy()->assertNoContent();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function deleteDestroy()
    {
        return $this->deleteJson(route('comments.destroy', ['comment' => 1]));
    }
}
