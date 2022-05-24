<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if ($request->user()->account_type === 'teacher') {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $request->user()->courses()->with('announcements', 'assignments', 'user')->first(),
                'courses' => $request->user()->courses()->get(),
            ]);
        } else {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $request->user()->course_followings()->with('announcements', 'assignments', 'user')->first(),
                'courses' => $request->user()->course_followings()->get(),
            ]);
        }
    }

    /**
     * @param StoreCourseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $request->user()->courses()->create(array_merge($request->validated(), [
            'keycode' => Str::random(20),
        ]));
        return back();
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return Response
     */
    public function show(Request $request, Course $course): Response
    {
        if((Auth::user()->account_type === 'teacher')) {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $course->with('announcements', 'assignments', 'user')->where('id', $course->getKey())->first(),
                'courses' => $request->user()->courses()->get(),
            ]);
        } else {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $course->with('announcements', 'assignments', 'user')->where('id', $course->getKey())->first(),
                'courses' => $request->user()->course_followings()->get(),
            ]);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store_course_follow(Request $request): RedirectResponse
    {
        $course = Course::all()->where('keycode', $request->input('keycode'))->first();
        $course->course_followers()->attach(Auth::id());
        return back();
    }
}
