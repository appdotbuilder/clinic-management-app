<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page.
     */
    public function index(Request $request)
    {
        return view('welcome', [
            'user' => $request->user()
        ]);
    }
}