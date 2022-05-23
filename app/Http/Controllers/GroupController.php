<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class GroupController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    function index(Request $request): Response
    {
        return Inertia::render('Groups', [
            'user' => Auth::user(),
            'group' => $request->user()->groups()->with('user')->where('user_id', Auth::id())->first(),
            'groups' => $request->user()->groups()->get(),
        ]);
    }

    /**
     * @param StoreGroupRequest $request
     * @return RedirectResponse
     */
    public function store(StoreGroupRequest $request): RedirectResponse
    {
        $request->user()->groups()->create(array_merge($request->validated(), [
            'keycode' => Str::random(20),
        ]));
        return back();
    }

    /**
     * @param Request $request
     * @param Group $group
     * @return Response
     */
    public function show(Request $request, Group $group): Response
    {
        return Inertia::render('Groups', [
            'user' => Auth::user(),
            'group' => $group->with('user')->where('id', $group->getKey())->get()[0],
        ]);
    }

    /**
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse
     */
    public function store_follow(Request $request, Group $group): RedirectResponse
    {
        $group->followers()->attach(Auth::id());
        return back();
    }
}
