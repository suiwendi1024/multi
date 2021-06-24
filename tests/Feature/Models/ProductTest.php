<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\Traits\CategoryTrait;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase,
        CategoryTrait;

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = factory(\App\Models\Product::class)->states( 'withCategory')->create();
    }
}
