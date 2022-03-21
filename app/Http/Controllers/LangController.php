<?php

namespace App\Http\Controllers;

use Session;

class LangController extends Controller
{
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
