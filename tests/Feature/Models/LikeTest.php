<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\UserTrait;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase,
        UserTrait;

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\Models\Like::class)->states('withUser', 'withPost')->create();
    }
}
