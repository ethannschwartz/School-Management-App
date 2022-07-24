<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    /**
     * @param StoreCourseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $request->user()->courses()->create(array_merge($request->validated()));
        return back();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if($request->user()->account_type === 'teacher') {
            return Inertia::render('Teachers/Courses', [
                'course' => $request->user()->courses()->with('user', 'files')->first(),
                'courses' => $request->user()->courses()->get(),
            ]);
        } else {
            $teacher_ids = $request->user()->subscribings()->pluck('subscribed_id');

            return Inertia::render('Students/Courses', [
                'teachers' => fn() => $request->user()->subscribings()->with('courses')->get(),
                'teacher' => fn() => $request->user()->subscribings()->first(),
                'course' => fn() => Course::with('files', 'user')->whereIn('user_id',  $teacher_ids)->first(),
                'teacher_search' => Inertia::lazy(fn() => User::query()
                    ->where('account_type', 'teacher')
                    ->when($request->input('search'), function ($query, $search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->paginate(5)
                    ->withQueryString()
                    ->through(fn($user) => [
                        'id' => $user->id,
                        'prefix' => $user->prefix,
                        'name'=> $user->name,
                        'courses' => $user->courses,
                    ])
                ),
            ]);
        }
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return Response
     */
    public function show(Request $request, Course $course): Response
    {
        $teacher_ids = $request->user()->subscribings()->pluck('subscribed_id');

        if ($request->user()->account_type === 'teacher') {
            if($request->user()->getKey() === $course->user_id){
                return Inertia::render('Teachers/Courses', [
                    'course' => $course->with('user', 'files')->where('id', $course->getKey())->first(),
                    'courses' => $request->user()->courses()->get(),
                ]);
            } else {
                return Inertia::render('Unauthorized', [
                    'course' => $course->user()->get(),
                ]);
            }
        } else {
            if(in_array($course->user_id, $teacher_ids->toArray())){
                return Inertia::render('Students/Courses', [
                    'course' => Course::with('files', 'user')->where('id', $course->getKey())->first(),
                    'courses' => Course::all()->whereIn('user_id', $teacher_ids),
                    'teachers' => $request->user()->subscribings()->with('courses')->get(),
                ]);
            }
             else {
                return Inertia::render('Unauthorized', [
                    'course' => Course::with('user')->where('id', $course->getKey())->first(),
                    'courses' => Course::all()->where('user_id', $course->user()->getParentKey()),
                    'teachers' => $request->user()->subscribings()->with('courses')->get(),
                ]);
            }
        }
    }
}
