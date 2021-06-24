<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\CategoryTrait;
use Tests\Feature\Models\Traits\CommentTrait;
use Tests\Feature\Models\Traits\FavoriteTrait;
use Tests\Feature\Models\Traits\LikeTrait;
use Tests\Feature\Models\Traits\UserTrait;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase,
        UserTrait,
        CategoryTrait,
        CommentTrait,
        LikeTrait,
        FavoriteTrait;

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\Models\Post::class)->states('withUser', 'withCategory')->create();
    }
}
