<?php

namespace Tests\Feature\Models\Traits;

trait CommentTrait
{
    /**
     * 一对多关联Comment模型。
     */
    public function testModelHasComments()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->model->comments);
    }
}
