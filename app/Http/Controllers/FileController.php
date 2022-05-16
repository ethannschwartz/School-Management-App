<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index(Request $request)
    {
//        dd($request->user()->with('courses', 'groups', 'files')->where('id', $request->user()->getKey())->get());

         return Inertia::render('Profile', [
             'user' => $request->user()->with('courses', 'groups')->where('id', $request->user()->getKey())->get(),
             'photo' => $request->user()->file()->get(),
         ]);
    }

    public function store(StoreFileRequest $request)
    {
        $request->user()->file()->create($request->validated());
        return back();
    }
}
