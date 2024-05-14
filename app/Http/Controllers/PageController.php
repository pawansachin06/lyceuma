<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function mathjax(Request $req)
    {
        return view('pages.mathjax');
    }
}
