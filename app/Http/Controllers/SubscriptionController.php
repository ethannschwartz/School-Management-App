<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SubscriptionController extends Controller
{
    /**
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function index(Request $request): Response|RedirectResponse
    {
        if($request->user()->account_type === 'teacher') {
            return Inertia::render('Teachers/Subscribers', [
                'subscribers' => $request->user()->subscribers()->get(),
                'courses' => $request->user()->courses()->get(),
                'files' => $request->user()->files()->get(),
            ]);
        } else {
            return Redirect::route('courses.index');
        }
    }
}
