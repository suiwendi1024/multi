<?php

namespace App\Models;

use App\Models\Traits\HashidsTrait;
use App\Models\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Ware extends Model
{
    use ProductTrait,
        HashidsTrait;

    protected $fillable = [
        'subject_type',
        'subject_id',
        'quantity',
        'amount',
        'is_selected',
    ];

    protected $hidden = [
        'subject_type',
        'subject_id',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new \App\Scopes\ReverseScope());
        static::addGlobalScope('product', function (Builder $builder) {
            $builder->with('product');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }
}
