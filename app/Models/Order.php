<?php

namespace App\Models;

use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use UserTrait;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }
}
