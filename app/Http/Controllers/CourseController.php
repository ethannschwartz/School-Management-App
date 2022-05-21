<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->account_type === 'teacher')
        {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $request->user()->courses()->with('announcements', 'assignments')->first(),
                'courses' => $request->user()->courses()->get(),
            ]);
        } else {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $request->user()->follows()->get(),
                'courses' => $request->user()->courses()->get(),
            ]);
        }
    }

    public function store(StoreCourseRequest $request)
    {
        $request->user()->courses()->create(array_merge($request->validated(), [
            'keycode' => Str::random(20),
            'admin_prefix' => Auth::user()->prefix,
            'admin_name' => Auth::user()->name,
            'admin_email' => Auth::user()->email,
        ]));
        return back();
    }

    public function show(Request $request, Course $course)
    {

        if(Auth::user()->account_type === 'teacher' && $course->user_id === $request->user()->getKey()) {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $course->with('announcements', 'assignments')->where('id', $course->getKey())->get()[0],
                'courses' => $request->user()->courses()->get(),
            ]);
        } else if(Auth::user()->account_type === 'student') {
            return Inertia::render('Courses', [
                'user' => Auth::user(),
                'course' => $course->with('announcements', 'assignments')->findOrFail($course->getKey()),
                'courses' => $course->follows()->where('user_id', Auth::id())->get(),
            ]);
        } else {
            dd('You are not subscribed do this page.');
        }
    }

}
