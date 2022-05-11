<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function store(StoreAnnouncementRequest $request, Course $course)
    {
        $request->user()->announcements()->create(array_merge($request->validated(), [
            'course_id' => $course->getKey(),
            'prefix'     => Auth::user()->prefix,
            'name'      => Auth::user()->name,
        ]));
        return back();
    }
}
