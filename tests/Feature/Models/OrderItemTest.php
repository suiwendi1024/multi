<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\WithFaker;

class OrderItemTest extends ModelTest
{
    /**
     * 多对一关联Order模型。
     */
    public function testOrder()
    {
        $this->assertInstanceOf(\App\Models\Order::class, $this->model->order);
    }

    /**
     * 多对一关联Product模型。
     */
    public function testProduct()
    {
        $this->assertInstanceOf(\App\Models\Product::class, $this->model->product);
    }
}
