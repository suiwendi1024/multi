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

    /**
     * 按类型获取模型。
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int|string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
