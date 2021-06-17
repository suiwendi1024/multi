<?php

namespace App\Models\Traits;

trait CommentsTrait
{
    /**
     * 静态初始化方法。
     */
    public static function bootCommentsTrait()
    {
        // 默认查询当前模型的评论数量
        static::addGlobalScope('comments_count', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->withCount('comments');
        });
    }

    /**
     * 多态一对多关联Comment模型。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }
}
