<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\ExamChapter;
use App\Models\ExamDifficulty;
use App\Models\ExamSubject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ExamChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $items = ExamChapter::with('subject')->latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-chapters.index', ['items' => $items]);
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
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        try {
            $item = ExamChapter::create([
                'name' => 'New chapter',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading chapter...',
                'redirect' => route('exam-chapters.edit', $item),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
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
    public function edit(Request $req, ExamChapter $examChapter)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $statuses = ModelStatusEnum::toArray();
        $examSubjects = ExamSubject::get(['id', 'name']);
        $examDifficulties = ExamDifficulty::get(['id', 'name']);
        $examChapters = ExamChapter::get(['id', 'name']);
        return view('exam-chapters.edit', [
            'item' => $examChapter,
            'statuses' => $statuses,
            'examChapters' => $examChapters,
            'examDifficulties' => $examDifficulties,
            'examSubjects' => $examSubjects,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ExamChapter $examChapter)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
            'exam_subject_id' => [Rule::exists(ExamSubject::class, 'id')],
            'exam_chapter_id' => ['nullable', Rule::exists(ExamChapter::class, 'id')],
            'exam_difficulty_id' => [Rule::exists(ExamDifficulty::class, 'id')],
        ]);

        try {
            $examChapter->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Saved successfully',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, ExamChapter $examChapter)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        try {
            $examChapter->delete();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json([
            'success' => true,
            'reload' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
