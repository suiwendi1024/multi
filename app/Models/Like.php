<?php

namespace App\Models;

use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use UserTrait;

    protected $fillable = [
        'likeable_type',
        'likeable_id',
    ];

    protected $hidden = [
        'likeable_type',
        'likeable_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
