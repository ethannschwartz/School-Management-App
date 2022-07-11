<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Students/Settings');
    }
}
