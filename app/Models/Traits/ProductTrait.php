<?php

namespace App\Models\Traits;

trait ProductTrait
{
    /**
     * 动态初始化方法。
     */
    public function initializeProductTrait()
    {
        $attribute = 'product_id';

        $this->mergeFillable([$attribute])->makeHidden($attribute);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
