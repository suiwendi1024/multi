<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\UserTrait;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase,
        UserTrait;

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\Models\Order::class)->states('withUser')->create();
    }

    /**
     * 一对多关联OrderItem模型。
     */
    public function testModelHasItems()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->model->wares);
    }
}
