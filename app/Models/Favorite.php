<?php

namespace App\Models;

use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use UserTrait;

    protected $fillable = [
        'favoritable_type',
        'favoritable_id',
    ];

    protected $hidden = [
        'favoritable_type',
        'favoritable_id',
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
    }

    /**
     * 多态关联。
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function favoritable()
    {
        return $this->morphTo();
    }
}
