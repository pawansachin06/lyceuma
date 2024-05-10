<?php

namespace App\Http\Controllers;

use App\Models\ExamChapter;
use Illuminate\Http\Request;

class ExamChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ExamChapter::with('subject')->latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-chapters.index', ['items'=> $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamChapter $examChapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamChapter $examChapter)
    {
        return view('exam-chapters.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamChapter $examChapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamChapter $examChapter)
    {
        //
    }
}
