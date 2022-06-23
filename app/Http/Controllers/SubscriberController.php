<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SubscriberController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function index(Request $request): Response|RedirectResponse
    {
        if($request->user()->account_type === 'student') {
            return Inertia::render('Students/Teachers', [
                'teachers' => $request->user()->subscribings()->with('courses')->get(),
                'teacher' => $request->user()->subscribings()->first(),
                'course' => Course::with('files', 'user')->whereIn('user_id',  $request->user()->subscribings()->pluck('subscribed_id'))->first(),
            ]);
        } else {
            return Redirect::route('courses.index');
        }
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return RedirectResponse|Response
     */
    public function show(Request $request, Course $course): Response|RedirectResponse
    {
        $teacher_ids = $request->user()->subscribings()->pluck('subscribed_id');

        if($request->user()->account_type === 'student'){
            if (in_array($course->user_id, $teacher_ids->toArray())) {
                return Inertia::render('Students/Teachers', [
                    'teachers' => $request->user()->subscribings()->with('courses')->get(),
                    'course' => Course::with('files', 'user')->where('id', $course->getKey())->first(),
                ]);
            } else {
                return Inertia::render('Unauthorized', [
                    'teacher' => $course->user()->get(),
                ]);
            }
        } else {
            return Redirect::route('courses.index');
        }
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function store(Request $request, User $user): RedirectResponse
    {
        $user->subscribers()->attach($request->user()->getKey());
        return back();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->subscribers()->detach($request->user()->getKey());
        return back();
    }
}
