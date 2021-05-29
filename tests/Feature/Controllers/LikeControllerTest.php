<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $like = factory(\App\Models\Like::class)->state('new')->make(['id' => 1]);

        // 未登录
        $this->postStore()->assertUnauthorized();

        // 登录
        $this->actingAs($like->user); // 登录
        $this->postStore()->assertCreated();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postStore()
    {
        return $this->postJson(route('posts.likes.store', ['post' => 1]));
    }

    public function testDestroy()
    {
        $like = factory(\App\Models\Like::class)->state('new')->create();

        // 未登录
        $this->deleteDestroy()->assertUnauthorized();

        // 未授权
        $this->actingAs(factory(\App\User::class)->create());
        $this->deleteDestroy()->assertForbidden();

        // 授权
        $this->actingAs($like->user);
        $this->deleteDestroy()->assertNoContent();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function deleteDestroy()
    {
        return $this->deleteJson(route('posts.likes.destroy', ['post' => 1]));
    }
}
