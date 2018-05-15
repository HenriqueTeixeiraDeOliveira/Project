<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function create()
    {
        return view('lessons.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'subject_id' => ['required'],
            'title' => ['required'],
            'subtitle' => ['required'],
            'link' => ['required']
        ]);

        $lesson = Lesson::create([
            'subject_id' => request('subject_id'),
            'professor_id' => auth()->id(),
            'title' => request('title'),
            'subtitle' => request('subtitle'),
            'link' => request('link'),
        ]);

        return redirect('lessons.show');
    }

    public function show($lessonId)
    {
        $lesson = Lesson::published()->findOrFail($lessonId);
        return view('lessons.show', ['lesson' => $lesson]);
    }
}