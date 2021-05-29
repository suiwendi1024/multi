<?php

namespace App\Models\Traits;

trait FavoriteTrait
{
    /**
     * 静态初始化方法。
     */
    public static function bootFavoriteTrait()
    {
        // 默认查询当前模型的收藏数量
        static::addGlobalScope('favorites_count', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->withCount('favorites');
        });
    }

    /**
     * 动态初始化方法。
     */
    public function initializeFavoriteTrait()
    {
        $this->append('is_favorited')->makeHidden('user_favorites_count');
    }

    /**
     * 追加is_favorited属性。
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAppendIsFavorited($query)
    {
        return $query->withCount('user_favorites');
    }

    /**
     * 获取用户对当前模型的收藏。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function user_favorites()
    {
        return $this->favorites()->where('user_id', auth()->id());
    }

    /**
     * 获取当前模型的收藏。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(\App\Models\Favorite::class, 'favoritable');
    }

    /**
     * 获取is_favorited属性。
     *
     * @return bool
     */
    public function getIsFavoritedAttribute()
    {
        return (bool)$this->user_favorites_count;
    }
}
