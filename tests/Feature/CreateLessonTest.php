<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateLessonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_may_not_create_lessons()
    {
        $this->withExceptionHandling();

        $this->get('/lessons/create')
            ->assertRedirect('/login');

        $this->post('/lessons')
            ->assertRedirect('/login');
    }
}