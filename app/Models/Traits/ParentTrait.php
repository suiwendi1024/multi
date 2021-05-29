<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ParentTrait
{
    /**
     * 动态初始化方法。
     */
    public function initializeParentTrait()
    {
        $attribute = 'parent_id';

        // 默认允许修改parent_id属性并隐藏
        $this->mergeFillable([$attribute])->makeHidden($attribute);
    }

    /**
     * 按代数获取模型。
     *
     * @param  Builder  $query
     * @param  int  $number
     * @return Builder
     */
    public function scopeOfGeneration(Builder $query, int $number)
    {
        if ($number < 1) {
            return $query;
        } elseif ($number == 1) {
            return $this->scopeFirstGeneration($query);
        } else {
            $relation = join('.', array_pad([], $number - 1, 'parent'));

            return $query->whereHas($relation, function (Builder $builder) {
                $builder->firstGeneration();
            });
        }
    }

    /**
     * 获取第一代模型。
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeFirstGeneration($query)
    {
        return $query->where('parent_id', 0);
    }

    /**
     * 多对一关联模型本身。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class);
    }

    /**
     * 一对多关联模型本身。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
