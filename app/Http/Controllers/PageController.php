<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function dashboard(Request $req)
    {
        // user's current session id is stored
        // $this_device_session = Session::getId();
        $this_device_session = $req->session()->getId();
        // check in sessions table.
        // If record exist then delete it skipping the current session.
        if (DB::table('sessions')->where('id', '!=', $this_device_session)->where('user_id', Auth::user()->id)->exists()) {
            // delete their session
            DB::table('sessions')->where('id', '!=', $this_device_session)->where('user_id', Auth::user()->id)->delete();
        }
        return view('dashboard');
    }

    public function mathjax(Request $req)
    {
        return view('pages.mathjax');
    }
}
