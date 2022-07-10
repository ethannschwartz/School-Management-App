<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse|Response
     */
    public function show(Request $request, User $user): Response|RedirectResponse
    {
        if($request->user()->account_type === 'teacher') {
            return Inertia::render('Teachers/Profile', [
                'profile' => $request->user()->profile,
            ]);
        } else {
            return Redirect::route('courses.index');
        }
    }

    /**
     * @param StoreProfileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProfileRequest $request): RedirectResponse
    {
        $path = $request->file('profile_image')->store('files', 's3');

        Storage::disk('s3')->setVisibility($path, 'public');

        $request->user()->profile()->updateOrCreate(array_merge($request->validated(), [
            'institution'    => $request->input('institution'),
            'subject'        => $request->input('subject'),
            'profile_image' => Storage::disk('s3')->url($path),
        ]));
        return back();

    }
}
