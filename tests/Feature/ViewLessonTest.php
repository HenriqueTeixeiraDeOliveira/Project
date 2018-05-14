<?php

namespace Tests\Feature;

use App\Lesson;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewLessonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_watch_a_published_video_lesson()
    {

        //$this->withoutExceptionHandling();

        $lesson = factory(Lesson::class)->states('published')->create([
            'subject_id' => "1",
            'professor_id' => "1",
            'title' => "Isomeria Espacial",
            'subtitle' => "Neque porro quisquam est qui dolorem ipsum",
            'link' => 'https://youtu.be/t_bOaAf_E0c',
        ]);

        $response = $this->get('/lessons/'.$lesson->id);

        $response->assertStatus(200);
        $response->assertSee('Isomeria Espacial');
        $response->assertSee('Neque porro quisquam est qui dolorem ipsum');
        $response->assertSee('https://youtu.be/t_bOaAf_E0c');

    }

    /** @test */
    public function user_cannot_watch_a_unpublished_video_lesson()
    {
        $lesson = factory(Lesson::class)->states('unpublished')->create();

        $response = $this->get('/lessons/'.$lesson->id);

        $response->assertStatus(404);
    }
}
