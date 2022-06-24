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
use \CloudConvert\CloudConvert;
use \CloudConvert\Models\Job;
use \CloudConvert\Models\Task;

class FileController extends Controller
{

    /**
     * @param StoreFileRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function store(StoreFileRequest $request, Course $course): RedirectResponse
    {
        $cloudconvert = new CloudConvert(['api_key' => env('CLOUDCONVERT_API_KEY')]);
//
//        $job = (new Job())
//            ->addTask(
//                (new Task('import/upload', 'test-file'))
//            )
//            ->addTask(
//                (new Task('convert', 'convert-to-epub'))
//                    ->set('input_format', 'pdf')
//                    ->set('output_format', 'epub')
//                    ->set('engine', 'calibre')
//                    ->set('input', ["test-file"])
//                    ->set('engine_version', '5.37')
//                    ->set('filename', 'output.epub')
//            )
//            ->addTask(
//                (new Task('export/s3', 'epub-file'))
//                    ->set('input', ["convert-to-epub"])
//                    ->set('bucket', env('AWS_BUCKET'))
//                    ->set('region', env('AWS_DEFAULT_REGION'))
//                    ->set('access_key_id', env('AWS_ACCESS_KEY_ID'))
//                    ->set('secret_access_key', env('AWS_SECRET_ACCESS_KEY'))
//            );
//
//        $cloudconvert->jobs()->create($job);

//        dd($request->file('file')->getClientOriginalName());
        $job = (new Job())
            ->addTask(
                (new Task('import/upload', $request->file('file')->getClientOriginalName()))
            )
            ->addTask(
                (new Task('convert', 'convert-to-epub'))
                    ->set('input_format', 'pdf')
                    ->set('output_format', 'epub')
                    ->set('engine', 'calibre')
                    ->set('input', ["test-file"])
                    ->set('engine_version', '5.37')
                    ->set('filename', 'output.epub')
            )
            ->addTask(
                (new Task('export/s3', 'epub-file'))
                    ->set('input', ["convert-to-epub"])
                    ->set('bucket', env('AWS_BUCKET'))
                    ->set('region', env('AWS_DEFAULT_REGION'))
                    ->set('access_key_id', env('AWS_ACCESS_KEY_ID'))
                    ->set('secret_access_key', env('AWS_SECRET_ACCESS_KEY'))
            );

        $cloudconvert->jobs()->create($job);

        dd($cloudconvert);


//        $path = $request->file('file')->store('files', 's3');

//        Storage::disk('s3')->setVisibility($path, 'public');
//
//        File::create([
//            'title' => $request->input('title'),
//            'filename' => basename($path),
//            'url'     => Storage::disk('s3')->url($path),
//            'user_id' => Auth::id(),
//            'course_id' => $course->getKey(),
//        ]);
//        return back();
    }


    /**
     * @param Request $request
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
