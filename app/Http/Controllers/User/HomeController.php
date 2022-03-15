<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $songs = [];
        return view('welcome', compact('songs'));
    }
}
