<?php

namespace App\Models;

use App\Models\Traits\LikeTrait;
use App\Models\Traits\ParentTrait;
use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use UserTrait,
        ParentTrait,
        LikeTrait;

    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'body',
    ];

    protected $hidden = [
        'commentable_type',
        'commentable_id',
    ];

    /**
     * 执行模型引导后所需的任何操作。
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new \App\Scopes\ReverseScope());
        static::addGlobalScope(new \App\Scopes\UserScope());
    }

    /**
     * 多态关联。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
