<?php

namespace App\Models\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashidsTrait
{
    public function attributesToArray()
    {
        $array = parent::attributesToArray();

        if (array_key_exists($this->getKeyName(), $array)) {
            $array[$this->getKeyName()] = $this->getHashIdAttribute();
        }

        return $array;
    }

    public function getHashIdAttribute()
    {
        return Hashids::encode($this->getKey());
    }

    public function getRouteKey()
    {
        return Hashids::encode(parent::getRouteKey());
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return parent::resolveRouteBinding(current(Hashids::decode($value)), $field);
    }
}
