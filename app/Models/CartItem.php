<?php

namespace App\Models;

use App\Models\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use ProductTrait;

    protected $fillable = [
        'cart_id',
        'quantity',
        'amount',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(\App\Models\Cart::class);
    }
}
