<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $products = factory(\App\Models\Product::class, 2)->states('withCategory')->create();
        $con = $this->getConnection();

        $con->enableQueryLog(); // 开启查询记录

        // 逆序
        $this->get(route('posts.index'))->assertSeeInOrder([
            $products[1]->title,
            $products[0]->title,
        ]);

        $con->disableQueryLog(); // 关闭查询记录

        // 没有重复查询
        $queries = array_column($con->getQueryLog(), 'query');
        $this->assertSameSize(array_unique($queries), $queries);
    }

    /**
     * 测试show方法可以显示产品。
     */
    public function testShow()
    {
        $product = factory(\App\Models\Product::class)->states('withCategory')->create();

        $this->get($product->path)->assertSee($product->name);
    }
}
