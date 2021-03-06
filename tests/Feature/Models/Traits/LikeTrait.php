<?php

namespace Tests\Feature\Models\Traits;

trait LikeTrait
{
    /**
     * 一对多关联Like模型。
     */
    public function testModelHasLikes()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->model->likes);
    }
}
