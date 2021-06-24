<?php

namespace App\Models;

use App\Models\Traits\HashidsTrait;
use App\Models\Traits\ParentTrait;
use App\Models\Traits\PostsTrait;
use App\Models\Traits\TypeTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use PostsTrait,
        ParentTrait,
        TypeTrait,
        HashidsTrait;

    protected $fillable = [
        'name',
        'description',
    ];
}
