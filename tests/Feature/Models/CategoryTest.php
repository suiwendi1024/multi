<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\PostTrait;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase,
        PostTrait;

    /**
     * @var \App\Models\Category|\App\Models\Category[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\Models\Category::class)->create();
    }
}
