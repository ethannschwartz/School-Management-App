<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SubscriptionController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Teachers/Subscribers', [
            'subscribers' => $request->user()->subscribers()->get(),
            'course' => $request->user()->courses()->first(),
            'courses' => $request->user()->courses()->get(),
        ]);
    }
}
