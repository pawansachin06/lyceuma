<?php

namespace App\Http\Controllers;

use App\Models\QuestionTable;
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

        $user = $req->user();

        $cards = [];
        if($user->isSuperAdmin() || $user->isAdmin() || $user->isEditor()){
            $tablesObj = QuestionTable::get(['id', 'name', 'classroom_id', 'subject_id', 'table']);
            if(!empty($tablesObj)){
                foreach ($tablesObj as $tableObj) {
                    $count = DB::table($tableObj->table)->count();
                    $cards[] = [
                        'title'=> $tableObj->name,
                        'content'=> $count,
                        'link'=> route('questions.index', [
                            'classroomId' => $tableObj->classroom_id,
                            'subjectId' => $tableObj->subject_id,
                        ]),
                    ];
                }
                usort($cards, function($a, $b){
                    $aContent = intval($a['content']);
                    $bContent = intval($b['content']);
                    return $aContent < $bContent;
                });
            }
        }
        return view('dashboard', [
            'user'=> $user,
            'cards'=> $cards,
        ]);
    }

    public function mathjax(Request $req)
    {
        return view('pages.mathjax');
    }
}
