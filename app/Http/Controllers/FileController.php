<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Course;
use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{

    /**
     * @param StoreFileRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function store(StoreFileRequest $request, Course $course): RedirectResponse
    {
        $path = $request->file('file')->store('files', 's3');

        Storage::disk('s3')->setVisibility($path, 'public');

        File::create([
            'title' => $request->input('title'),
            'filename' => basename($path),
            'url'     => Storage::disk('s3')->url($path),
            'user_id' => Auth::id(),
            'course_id' => $course->getKey(),
        ]);
        return back();
    }

    /**
     * @param File $file
     * @return StreamedResponse
     */
    public function show(Request $request, File $file): StreamedResponse
    {
        return Storage::disk('s3')->response('files/' . $file->filename);

//        if(Auth::user()===$request->user()){
//            return Inertia::render('FileViewer', [
//                'file' => $response,
//            ]);
//        } else {
//            return Inertia::render('Courses');
//        }
    }
}
