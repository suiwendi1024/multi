<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

abstract class ModelTest extends TestCase
{
    use RefreshDatabase;

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();

        $class = 'App\Models\\' . str_replace('Test', '', class_basename(static::class));
        $this->model = factory($class)->state('new')->create();
    }
}
