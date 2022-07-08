<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return Inertia::render('Teachers/Profile', [
            'profile' => $user->profile(),
        ]);
    }

    /**
     * @param StoreProfileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProfileRequest $request): RedirectResponse
    {
        $path = $request->file('profile_image')->store('files', 's3');

        Storage::disk('s3')->setVisibility($path, 'public');

        $request->user()->profile()->create(array_merge($request->validated(), [
            'profile_image' => Storage::disk('s3')->url($path),
        ]));
        return back();
    }

    public function update(Request $request)
    {

    }
}
