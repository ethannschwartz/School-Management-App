<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SettingsController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if($request->user()->account_type === 'teacher'){
            return Inertia::render('Teachers/Settings');
        } else {
            return Inertia::render('Students/Settings');
        }
    }

    /**
     * @param Request $request
     * @param Settings $setting
     * @return Response
     */
    public function show(Request $request, Settings $setting): Response
    {
        if($request->user()->account_type === 'teacher'){
            return Inertia::render('Teachers/Settings');
        } else {
            return Inertia::render('Students/Settings', [
                'setting' => $setting,
            ]);
        }
    }
}
