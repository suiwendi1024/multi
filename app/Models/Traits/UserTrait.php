<?php

namespace App\Models\Traits;

trait UserTrait
{
    /**
     * 动态初始化方法。
     */
    public function initializeUserTrait()
    {
        $attribute = 'user_id';

        // 默认允许修改user_id属性并隐藏
        $this->mergeFillable([$attribute])->makeHidden($attribute);
    }

    /**
     * 多对一关联User模型。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfUser($query, int $id)
    {
        return $query->whereHas('user', function ($builder) use ($id) {
            $builder->where('id', $id);
        });
    }
}
