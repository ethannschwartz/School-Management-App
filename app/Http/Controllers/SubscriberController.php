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
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Students/Teachers', [
            'teachers' => $request->user()->subscribings()->with('courses')->get(),
            'teacher' => $request->user()->subscribings()->first(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function show(Request $request, User $user): Response
    {
        return Inertia::render('Students/Teachers', [
            'teachers' => $request->user()->subscribings()->with('courses')->get(),
            'teacher' => $request->user()->subscribings()->where('user_id', $user->getKey())->get(),
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
