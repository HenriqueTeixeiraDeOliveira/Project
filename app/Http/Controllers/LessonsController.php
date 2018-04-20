<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function show($lessonId)
    {
        $lesson = Lesson::published()->findOrFail($lessonId);
        return view('lessons.show', ['lesson' => $lesson]);
    }
}
