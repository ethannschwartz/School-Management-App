<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(Request $request)
    {
        $request->user()->course()->get();
    }
}
