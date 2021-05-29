<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\LikeTrait;
use Tests\Feature\Models\Traits\UserTrait;

class CommentTest extends ModelTest
{
    use UserTrait,
        LikeTrait;
}
