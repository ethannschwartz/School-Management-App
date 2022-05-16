<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Models\Course;

class FollowerController extends Controller
{
    public function store(StoreFollowRequest $request, Course $course)
    {
        $course->followers()->create(array_merge($request->validated(), [
            'user_id' => $request->user()->id,
            'course_id' => $course->where('keycode', $request->input('keycode'))->pluck('id')->get('id'),
        ]));
        return back();
    }
}

//KZzBQBpo0bjV2I5CDkJr
