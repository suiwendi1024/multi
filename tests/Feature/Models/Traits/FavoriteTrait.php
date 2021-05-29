<?php

namespace Tests\Feature\Models\Traits;

trait FavoriteTrait
{
    /**
     * 一对多关联Favorite模型。
     */
    public function testFavorites()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->model->favorites);
    }
}
