<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SubscriberController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function index(Request $request, User $user): Response
    {
        $teachers = $request->user()->with('courses')->where('account_type', 'teacher')->get();

        return Inertia::render('Students/TeacherSearch', [
            'teachers' => $teachers,
            'subscribings' => $user->subscribings()->get(),
        ]);
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
