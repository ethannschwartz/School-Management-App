<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\RedirectResponse;

class FileController extends Controller
{
    /**
     * @param StoreFileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFileRequest $request): RedirectResponse
    {
        $request->file('file')->store('files');
        $request->user()->files()->create(array_merge($request->validated(), [
            'path' => $request->file->path(),
        ]));
        return back();
    }
}
