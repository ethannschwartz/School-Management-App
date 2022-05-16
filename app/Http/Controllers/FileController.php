<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index(Request $request)
    {
         return Inertia::render('Profile', [
             'user' => $request->user()->with('courses', 'groups')->where('id', $request->user()->getKey())->get(),
//             'file' => $request->user()->file()->get(),
         ]);
    }

    public function store(StoreFileRequest $request)
    {
        $request->user()->files('file')->create(array_merge($request->validated(), [
            'user_id' => $request->user()->id,
            'name'    => $request->user()->name,
        ]));
        return back()->with('success', 'file upload successful!');
    }
}
