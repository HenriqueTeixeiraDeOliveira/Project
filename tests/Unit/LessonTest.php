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
}
