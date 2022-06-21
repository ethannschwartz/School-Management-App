<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use phpDocumentor\Reflection\Types\Boolean;

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

        $subscribed = $request->user()->subscribings()->pluck('subscribed_id')->toArray();

//        dd($subscribed);

        return Inertia::render('Students/TeacherSearch', [
            'user' => Auth::user(),
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

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->subscribers()->attach($request->user()->getKey());
        return back();
    }
}
