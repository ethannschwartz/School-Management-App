<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Course;
use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class FileController extends Controller
{
    /**
     * @param StoreFileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFileRequest $request, Course $course): RedirectResponse
    {
        $path = $request->file('file')->store('files', 's3');

        Storage::disk('s3')->setVisibility($path, 'public');

        File::create([
            'filename' => basename($path),
            'url'     => Storage::disk('s3')->url($path),
            'user_id' => Auth::id(),
            'course_id' => $course->getKey(),
        ]);
        return back();
    }

    /**
     * @param Request $request
     * @param File $file
     * @return Response
     */
    public function show(Request $request, File $file): Response
    {
        $response = Storage::disk('s3')->response('files/' . $file->filename);

        if(Auth::user()===$request->user()){
            return Inertia::render('FileViewer', [
                'file' => $response,
            ]);
        } else {
            return Inertia::render('Courses');
        }
    }
}
