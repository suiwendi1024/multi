<?php

namespace Tests\Feature\Models\Traits;

trait UserTrait
{
    /**
     * 多对一关联User模型。
     */
    public function testModelHasUser()
    {
        $this->assertInstanceOf(\App\User::class, $this->model->user);
    }
}
