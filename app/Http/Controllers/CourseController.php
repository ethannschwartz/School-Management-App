<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Courses', [
            'user' => $request->user()->with('courses')->where('id', Auth::id())->get(),
        ]);
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
            'course' => $course,
            'user' => fn () => $request->user()->with('courses')->get(),
        ]);
    }

    public function find(Request $request, Course $course)
    {
        return Inertia::render('Courses', [
            'keycode_search_results' => $course->where('keycode', $request->input('keycode'))->get(),
        ]);
    }
}
