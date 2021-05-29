<?php

namespace App\Models;

use App\Models\Traits\CategoryTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CategoryTrait;

    protected $fillable = [
        'cover_url',
        'name',
        'price',
        'stock',
        'description',
    ];

    protected $appends = [
        'path',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new \App\Scopes\ReverseScope());
    }

    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return route('products.show', ['product' => $this->id]);
    }
}
