<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show()
    {
        return view('user.account.show');
    }

    public function edit()
    {
        return view('user.account.edit');
    }

    public function changePassword()
    {
        return view('user.account.change-password');
    }
}
