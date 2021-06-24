<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $favorite = factory(\App\Models\Favorite::class)->states('withUser', 'withPost')->make(['id' => 1]);

        // 未登录
        $this->postStore()->assertUnauthorized();

        // 登录
        $this->actingAs($favorite->user); // 登录
        $this->postStore()->assertCreated();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postStore()
    {
        return $this->postJson(route('posts.favorites.store', ['post' => 1]));
    }

    public function testDestroy()
    {
        $favorite = factory(\App\Models\Favorite::class)->states('withUser', 'withPost')->create();

        // 未登录
        $this->deleteDestroy()->assertUnauthorized();

        // 未授权
        $this->actingAs(factory(\App\User::class)->create());
        $this->deleteDestroy()->assertForbidden();

        // 授权
        $this->actingAs($favorite->user);
        $this->deleteDestroy()->assertNoContent();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function deleteDestroy()
    {
        return $this->deleteJson(route('posts.favorites.destroy', ['post' => 1]));
    }
}
