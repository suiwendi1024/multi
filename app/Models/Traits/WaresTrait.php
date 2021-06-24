<?php

namespace App\Models\Traits;

trait WaresTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function wares()
    {
        return $this->morphMany(\App\Models\Ware::class, 'subject');
    }
}
