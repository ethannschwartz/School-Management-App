<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Profile', [
            'user' => $request->user()->with('courses', 'groups')->where('id', $request->user()->getKey())->get(),
        ]);
    }
}
