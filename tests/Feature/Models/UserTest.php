<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\CommentTrait;
use Tests\Feature\Models\Traits\FavoriteTrait;
use Tests\Feature\Models\Traits\LikeTrait;
use Tests\Feature\Models\Traits\PostTrait;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase,
        PostTrait,
        CommentTrait,
        LikeTrait,
        FavoriteTrait;

    /**
     * @var \App\User|\App\User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\User::class)->create();
    }
}
