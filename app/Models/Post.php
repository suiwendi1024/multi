<?php

namespace App\Models;

use App\Models\Traits\CategoryTrait;
use App\Models\Traits\CommentTrait;
use App\Models\Traits\FavoriteTrait;
use App\Models\Traits\LikeTrait;
use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes,
        UserTrait,
        CategoryTrait,
        CommentTrait,
        LikeTrait,
        FavoriteTrait;

    protected $fillable = [
        'title',
        'body',
        'cover_url',
        'summary',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new \App\Scopes\ReverseScope());
        static::addGlobalScope(new \App\Scopes\UserScope());
        static::addGlobalScope(new \App\Scopes\CategoryScope());
    }

    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return route('posts.show', ['post' => $this->id, 'category' => $this->category->parent_id]);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $id)
    {
        return $query->whereHas('category', function (\Illuminate\Database\Eloquent\Builder $builder) use ($id) {
            $builder->where('parent_id', $id);
        });
    }
}
