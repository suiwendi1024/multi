<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\UserTrait;

class OrderTest extends ModelTest
{
    use UserTrait;

    /**
     * 一对多关联OrderItem模型。
     */
    public function testItems()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->model->items);
    }
}
