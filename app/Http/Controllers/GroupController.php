<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GroupController extends Controller
{
    function index(Request $request)
    {
        return Inertia::render('Groups', [
            'user' => $request->user()->with('groups')->where('id', Auth::id())->get(),
        ]);
    }

    public function store(StoreGroupRequest $request)
    {
        $request->user()->groups()->create(array_merge($request->validated(), [
            'keycode' => Str::random(20),
            'admin_prefix' => Auth::user()->prefix,
            'admin_name' => Auth::user()->name,
            'admin_email' => Auth::user()->email,
        ]));
        return back();
    }

    public function show(Request $request, Group $group)
    {
        return Inertia::render('Groups', [
            'group' => $group,
            'user' => $request->user()->with('groups')->where('id', Auth::id())->get(),
        ]);
    }
}
