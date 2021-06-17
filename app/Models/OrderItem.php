<?php

namespace App\Models;

use App\Models\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use ProductTrait;

    protected $fillable = [
        'order_id',
        'quantity',
        'amount',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }
}
