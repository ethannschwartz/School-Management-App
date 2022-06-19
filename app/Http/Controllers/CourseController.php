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
        if($request->user()->account_type === 'teacher') {
            return Inertia::render('Teachers/Courses', [
                'user' => Auth::user(),
                'course' => $request->user()->courses()->with('user', 'files')->first(),
                'courses' => $request->user()->courses()->get(),
            ]);
        } else {
            return Inertia::render('Students/Courses', [
                'user' => Auth::user(),
                'course' => $request->user()->followings()->with('user', 'files')->first(),
                'courses' => $request->user()->followings()->get(),
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
        if ($request->user()->account_type === 'teacher') {
            if($request->user()->getKey() === $course->user_id){
                return Inertia::render('Teachers/Courses', [
                    'user' => Auth::user(),
                    'course' => $course->with('user', 'files')->where('id', $course->getKey())->first(),
                    'courses' => $request->user()->courses()->get(),
                ]);
            } else {
                return Inertia::render('Unauthorized', [
                    'user' => Auth::user(),
                    'course' => $course->user()->get(),
                ]);
            }

        } else {
            if($course->followers()->where('user_id' === $request->user()->getKey())){
                return Inertia::render('Students/Courses', [
                    'user' => Auth::user(),
                    'course' => $request->user()->followings()->with('user', 'files')->first(),
                    'courses' => $request->user()->followings()->get(),
                ]);
            }
             else {
                return Inertia::render('Unauthorized', [
                    'user' => Auth::user(),
                    'course' => $course->user()->get(),
                ]);
            }
        }
    }
}
