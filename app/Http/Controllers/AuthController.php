<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function showForgotPasswordForm()
    {
        return view('pages.forgot-password');
    }
}
