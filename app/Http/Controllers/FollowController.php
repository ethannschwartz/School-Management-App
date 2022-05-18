<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Models\Course;

class FollowController extends Controller
{
    public function store(StoreFollowRequest $request, Course $course)
    {
        $course->follows()->create(array_merge($request->validated(), [
            'user_id' => $request->user()->id,
            'course_id' => $course->where('keycode', $request->input('keycode'))->get()[0]->id,
        ]));
        return back();
    }
}
