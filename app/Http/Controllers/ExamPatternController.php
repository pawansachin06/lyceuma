<?php

namespace App\Http\Controllers;

use App\Models\ExamPattern;
use Illuminate\Http\Request;

class ExamPatternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ExamPattern::with('type')->latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-patterns.index', ['items' => $items]);
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
    public function show(ExamPattern $examPattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamPattern $examPattern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamPattern $examPattern)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamPattern $examPattern)
    {
        //
    }
}
