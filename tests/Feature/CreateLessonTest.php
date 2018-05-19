<?php

namespace Tests\Feature;

use App\Lesson;
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

    /** @test */
    public function an_authenticated_user_can_create_new_lessons()
    {
        $this->signIn();

        $this->get('/lessons/create')
             ->assertStatus(200);

        $lesson = factory(Lesson::class)->states('published')->make();

        $response = $this->post('/lessons', $lesson->toArray());

        $this->get($response->headers->get('Location'))
             ->assertSee($lesson->title)
             ->assertSee($lesson->subtitle);
    }

    /** @test */
    public function unauthorized_users_may_not_delete_lessons()
    {
        $lesson = create('App\Lesson');

        $this->delete('/lessons/' . $lesson->id)
             ->assertRedirect('/login');

        $this->signIn();

        $this->delete('/lessons/' . $lesson->id)
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_lessons()
    {
        $this->signIn();

        $lesson = create('App\Lesson', ['professor_id' => auth()->id()]);

        $this->assertDatabaseHas('lessons',['id' => $lesson->id]);

        $response = $this->json('DELETE','/lessons/' . $lesson->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('lessons',['id' => $lesson->id]);
    }
}