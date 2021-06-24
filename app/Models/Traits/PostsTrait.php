<?php

namespace App\Models\Traits;

trait PostsTrait
{
    /**
     * 一对多关联Post模型。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
}
