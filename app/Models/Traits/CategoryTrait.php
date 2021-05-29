<?php

namespace App\Models\Traits;

trait CategoryTrait
{
    /**
     * 动态初始化方法。
     */
    public function initializeCategoryTrait()
    {
        $attribute = 'category_id';

        $this->mergeFillable([$attribute])->makeHidden($attribute);
    }

    /**
     * 多对一关联Category模型。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
