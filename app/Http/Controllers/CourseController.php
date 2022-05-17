<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index(Request $request, Course $course, Follower $follower)
    {
        if(Auth::user()->account_type === 'teacher')
        {
            return Inertia::render('Courses', [
                'user' => $request->user()->with('courses')->where('id', Auth::id())->get(),
                'course' => $request->user()->courses()->with('announcements', 'assignments')->get(),
            ]);
        } else {
//            dd($request->user()->courses()->followers()->get());
//            return Inertia::render('Courses', [
//                'user' => $request->user()->with('courses')->where('id', Auth::id())->get(),
//                'course' => $follower->where('user_id', Auth::id())->get('course_id'),
//            ]);
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
        return Inertia::render('Courses', [
            'user' => $request->user()->with('courses')->where('id', Auth::id())->get(),
            'course' => $course->with('announcements', 'assignments')->where('id', $course->id)->get(),
        ]);
    }

}
