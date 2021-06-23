<?php

namespace App\Models\Traits;

trait TypeTrait
{
    /**
     * 动态初始化方法。
     */
    public function initializeTypeTrait()
    {
        $attribute = 'type';

        // 默认允许修改type属性并隐藏
        $this->mergeFillable([$attribute])->makeHidden($attribute);
    }
}
