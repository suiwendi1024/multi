<?php

namespace Tests\Feature\Models\Traits;

trait PostTrait
{
    /**
     * 一对多关联Post模型。
     */
    public function testModelHasPosts()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->model->posts);
    }
}
