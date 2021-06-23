<?php

namespace App\Models\Traits;

use App\Models\Like;

trait LikesTrait
{
    /**
     * 静态初始化方法。
     */
    public static function bootLikesTrait()
    {
        // 默认查询当前模型的点赞数量
        static::addGlobalScope('likes_count', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->withCount('likes');
        });
    }

    /**
     * 动态初始化方法。
     */
    public function initializeLikeTrait()
    {
        // 默认隐藏user_likes_count属性，暴露is_liked属性
        $this->makeHidden('user_likes_count')->append('is_liked');
    }

    /**
     * 追加is_liked属性。
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAppendIsLiked($query)
    {
        return $query->withCount('user_likes');
    }

    /**
     * 获取登录用户对当前模型的点赞。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function user_likes()
    {
        return $this->likes()->where('user_id', auth()->id());
    }

    /**
     * 多态一对多关联Like模型。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * 获取is_liked属性。
     *
     * @return bool
     */
    public function getIsLikedAttribute()
    {
        return (bool)$this->user_likes_count;
    }
}
