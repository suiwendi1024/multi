<?php

namespace Tests\Feature\Models\Traits;

trait CategoryTrait
{
    /**
     * 多对一关联Category模型。
     */
    public function testModelHasCategory()
    {
        $this->assertInstanceOf(\App\Models\Category::class, $this->model->category);
    }
}
