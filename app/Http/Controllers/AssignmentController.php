<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function store(StoreAssignmentRequest $request, Course $course, User $user)
    {
        $request->user()->assignments()->create(array_merge($request->validated(), [
            'course_id' => $course->getKey(),
            'user_id'   => $user->getKey(),
        ]));
        return back();
    }
}
