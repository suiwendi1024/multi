<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\LikeTrait;
use Tests\Feature\Models\Traits\UserTrait;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase,
        UserTrait,
        LikeTrait;

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\Models\Comment::class)->states('withUser', 'withPost')->create();
    }
}
