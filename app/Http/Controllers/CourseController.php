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
    public function index(Request $request, Course $course)
    {
        if(Auth::user()->account_type === 'teacher')
        {
            return Inertia::render('Courses', [
                'user' => $request->user()->with('courses')->where('id', Auth::id())->get(),
                'courses' => $request->user()->courses()->get(),
                'course' => $request->user()->courses()->with('announcements', 'assignments')->get(),
            ]);
        } else {
            return Inertia::render('Courses', [
//                'user' => $request->user()->where('id', Auth::id())->get(),
                'user' => $request->user()->with('courses')->where('id', Auth::id())->get(),

                'course' => $request->user()->follows()->where('user_id', Auth::id())->get()
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
        if(Auth::user()->account_type === 'teacher') {
            return Inertia::render('Courses', [
                'user' => $request->user()->where('id', Auth::id())->get(),
                'courses' => $request->user()->courses()->get(),
                'course' => $course->with('announcements', 'assignments')->where('id', $course->id)->get(),
            ]);
        } else {
            dd($course->follows()->getParent());
//            return Inertia::render('Courses', [
//                'user' => $request->user()->where('id', Auth::id())->get(),
//                'course' => $course->with('announcements', 'assignments')->where('id', $course->id)->get(),
//                'course' => $request->user()->follows()->with('course')->where('user_id', Auth::id())->findOrFail($course->id),
//                'course' => $course->follows()->where('user_id', Auth::id())->getParent(),
//            ]);
        }

    }

}
