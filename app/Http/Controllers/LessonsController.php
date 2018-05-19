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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('lessons.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'channel_id' => ['required'],
            'title' => ['required'],
            'subtitle' => ['required'],
            'link' => ['required']
        ]);

        $lesson = Lesson::create([
            'channel_id' => request('channel_id'),
            'professor_id' => auth()->id(),
            'title' => request('title'),
            'subtitle' => request('subtitle'),
            'link' => request('link'),
            'published_at' => request('published_at')
        ]);

        return redirect($lesson->path());
    }

    /**
     * @param $lessonId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($channel, $lessonId)
    {
        $lesson = Lesson::published()->findOrFail($lessonId);
        return view('lessons.show', ['lesson' => $lesson]);
    }

    /**
     * @param Lesson $lesson
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy ($channel, Lesson $lesson)
    {
        $this->authorize('update',$lesson);

        $lesson->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/lessons');
    }
}