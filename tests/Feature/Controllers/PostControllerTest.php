<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 测试index方法查询结果是逆序的，且没有重复查询。
     */
    public function testIndex()
    {
        // 由于要查询排行榜，所以生成大于排行榜数量10的数据
        $posts = factory(\App\Models\Post::class, 15)->states('withUser', 'withCategory')->create();
        $con = $this->getConnection();

        $con->enableQueryLog(); // 开启查询记录

        // 逆序
        $this->get(route('posts.index'))->assertSeeInOrder([
            $posts[1]->title,
            $posts[0]->title,
        ]);

        $con->disableQueryLog(); // 关闭查询记录

        // 没有重复查询
        $queries = array_column($con->getQueryLog(), 'query');
        $this->assertSameSize(array_unique($queries), $queries);
    }

    public function testCreate()
    {
        // 未登录
        $this->getCreate()->assertRedirect(route('login'));

        // 登录
        $this->actingAs(factory(\App\User::class)->create());
        $this->getCreate()->assertOk();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function getCreate()
    {
        return $this->get(route('posts.create'));
    }

    public function testStore()
    {
        $post = factory(\App\Models\Post::class)->states('withUser', 'withCategory')->make(['id' => 1]);

        // 未登录
        $this->postStore()->assertRedirect(route('login'));

        $this->actingAs($post->user); // 登录

        // 数据不合法
        $this->postStore()->assertSessionHasErrors();

        // 数据合法
        \Storage::fake(); // 切换测试目录
        $post->cover = \Illuminate\Http\UploadedFile::fake()->image('cover.jpg', 800, 600);
        $post->makeVisible('category_id'); // 临时暴露属性
        $this->postStore($post->toArray())->assertRedirect($post->path);
        \Storage::disk()->assertExists('images/' . $post->cover->hashName());
    }

    /**
     * @param  array  $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postStore(array $data = [])
    {
        return $this->post(route('posts.store'), $data);
    }

    /**
     * 测试show方法可以显示帖子。
     */
    public function testShow()
    {
        $post = $this->getPost();

        $this->get($post->path)->assertSee($post->title);

        // 浏览量+1
        $this->assertEquals($post->views + 1, $post->refresh()->views);
    }

    public function testEdit()
    {
        $post = $this->getPost();

        // 未登录
        $this->getEdit()->assertRedirect(route('login'));

        // 未授权
        $this->actingAs(factory(\App\User::class)->create());
        $this->getEdit()->assertForbidden();

        // 授权
        $this->actingAs($post->user);
        $this->getEdit()->assertSee($post->title);
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function getEdit()
    {
        return $this->get(route('posts.edit', ['post' => 1]));
    }

    public function testUpdate()
    {
        $post = $this->getPost();
        $user = factory(\App\User::class)->create();

        // 未登录
        $this->patchUpdate()->assertRedirect(route('login'));

        // 数据不合法
        $this->actingAs($user);
        $this->patchUpdate()->assertSessionHasErrors();

        // 未授权
        $this->actingAs($user);
        $this->patchUpdate($post->toArray())->assertForbidden();

        // 授权
        $this->actingAs($post->user);
        $this->patchUpdate($post->toArray())->assertRedirect($post->path);
    }

    /**
     * @param  array  $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function patchUpdate(array $data = [])
    {
        return $this->patch(route('posts.update', ['post' => 1]), $data);
    }

    public function testDestroy()
    {
        $post = $this->getPost();

        // 未登录
        $this->deleteDestroy()->assertRedirect(route('login'));

        // 未授权
        $this->actingAs(factory(\App\User::class)->create());
        $this->deleteDestroy()->assertForbidden();

        // 授权
        $this->actingAs($post->user);
        $this->deleteDestroy()->assertRedirect(route('posts.index'));
    }

    /**
     * @return \App\Models\Post|\App\Models\Post[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    protected function getPost()
    {
        return factory(\App\Models\Post::class)->states('withUser', 'withCategory')->create();
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function deleteDestroy()
    {
        return $this->delete(route('posts.destroy', ['post' => 1]));
    }
}
