<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeacherController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Students/Teachers', [
            'teachers' => $request->user(),
            'subscribings' => $request->user()->subscribings()->get(),
        ]);
    }
}
