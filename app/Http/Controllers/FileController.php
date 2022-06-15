<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * @param StoreFileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFileRequest $request): RedirectResponse
    {
        $path = $request->file('file')->store('files', 's3');
        File::create([
            'filename' => basename($path),
            'url'     => Storage::disk('s3')->url($path),
            'user_id' => Auth::id(),
        ]);
        return back();
    }
}
