<?php

namespace App\Models;

use App\Models\Traits\ParentTrait;
use App\Models\Traits\PostTrait;
use App\Models\Traits\TypeTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use PostTrait,
        ParentTrait,
        TypeTrait;

    protected $fillable = [
        'name',
        'description',
    ];
}
