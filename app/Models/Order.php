<?php

namespace App\Models;

use App\Models\Traits\UserTrait;
use App\Models\Traits\WaresTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use UserTrait,
        WaresTrait;

    protected $fillable = [
        'total',
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
}
