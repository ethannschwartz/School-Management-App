<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Models\Course;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;

class FollowController extends Controller
{
    /**
     * @param StoreFollowRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function store_course_follow(StoreFollowRequest $request, Course $course): RedirectResponse
    {
        $course->follow()->create(array_merge($request->validated(), [
            'user_id' => $request->user()->getKey(),
            'course_id' => $course->where('keycode', $request->input('keycode'))->get()[0]->id,
        ]));
        return back();
    }

    /**
     * @param StoreFollowRequest $request
     * @param Group $group
     * @return RedirectResponse
     */
    public function store_group_follow(StoreFollowRequest $request, Group $group): RedirectResponse
    {
        $group->follow()->create(array_merge($request->validated(), [
            'group_id' => 3,
//            'group_id' => $group->where('keycode', $request->input('keycode'))->get()[0]->id,
            'user_id' => $request->user()->getKey(),
        ]));
        return back();
    }
}
