<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\CategoryTrait;
use Tests\Feature\Models\Traits\CommentTrait;
use Tests\Feature\Models\Traits\FavoriteTrait;
use Tests\Feature\Models\Traits\LikeTrait;
use Tests\Feature\Models\Traits\UserTrait;

class PostTest extends ModelTest
{
    use UserTrait,
        CategoryTrait,
        CommentTrait,
        LikeTrait,
        FavoriteTrait;
}
