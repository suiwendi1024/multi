<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    use RefreshDatabase;

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\Models\OrderItem::class)->states('withProduct', 'withOrder')->create();
    }

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
