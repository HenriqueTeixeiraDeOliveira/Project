<?php

namespace Tests\Unit;

use App\Lesson;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_lesson_can_make_a_string_path()
    {
        $lesson = create('App\Lesson');
        $this->assertEquals("/lessons/{$lesson->channel->slug}/{$lesson->id}", $lesson->path());
    }

    /** @test */
    public function lessons_with_a_published_at_date_are_published()
    {
        $publishedLessonA = factory(Lesson::class)->create(['published_at' => Carbon::parse('-2 weeks')]);
        $publishedLessonB = factory(Lesson::class)->create(['published_at' => Carbon::parse('-1 weeks')]);
        $unpublishedLesson = factory(Lesson::class)->create(['published_at' => null]);

        $publishedLessons = Lesson::published()->get();

        $this->assertTrue($publishedLessons->contains($publishedLessonA));
        $this->assertTrue($publishedLessons->contains($publishedLessonB));
        $this->assertFalse($publishedLessons->contains($unpublishedLesson));
    }

    /** @test */
    public function a_lesson_belongs_to_a_channel()
    {
        $lesson = create('App\Lesson');
        $this->assertInstanceOf('App\Channel',$lesson->channel);
    }
}
