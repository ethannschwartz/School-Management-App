<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Models\User;
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
        return Inertia::render('Courses', [
            'user' => Auth::user(),
            'course' => $request->user()->courses()->with('user')->first(),
            'courses' => $request->user()->courses()->get(),
        ]);
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
        return Inertia::render('Courses', [
            'user' => Auth::user(),
            'course' => $course->with('user')->where('id', $course->getKey())->first(),
            'courses' => $request->user()->courses()->get(),
        ]);
    }
}
