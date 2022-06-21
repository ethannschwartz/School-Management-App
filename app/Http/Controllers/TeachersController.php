<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TeachersController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $teachers = $request->user()->where('account_type', 'teacher')->get();
        return Inertia::render('Students/TeacherSearch', [
            'user' => Auth::user(),
            'teachers' => $teachers,
        ]);
    }
}
