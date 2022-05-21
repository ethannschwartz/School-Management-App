<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyAnnouncementRequest;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Models\Announcement;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * @param StoreAnnouncementRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function store(StoreAnnouncementRequest $request, Course $course): RedirectResponse
    {
        $request->user()->announcements()->create(array_merge($request->validated(), [
            'course_id' => $course->getKey(),
            'prefix'     => Auth::user()->prefix,
            'name'      => Auth::user()->name,
        ]));
        return back();
    }

    /**
     * @param DestroyAnnouncementRequest $request
     * @param Announcement $announcement
     * @return RedirectResponse
     */
    public function destroy(DestroyAnnouncementRequest $request, Announcement $announcement): RedirectResponse
    {
        $announcement->delete();
        return back();
    }
}
