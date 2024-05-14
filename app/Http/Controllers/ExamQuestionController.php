<?php

namespace App\Http\Controllers;

use App\Enums\ExamAnswerTypeEnum;
use App\Enums\ModelStatusEnum;
use App\Models\ExamDifficulty;
use App\Models\ExamPattern;
use App\Models\ExamQuestion;
use App\Models\ExamSubject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ExamQuestionController extends Controller
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
        $items = ExamQuestion::with('difficulty:id,name')
                ->with('subject:id,name')
                ->with('pattern.type:id,name')
                ->latest()
                ->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-questions.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
            $item = ExamQuestion::create([
                'name' => '',
                'correct_answer' => 1,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading question...',
                'redirect' => route('exam-questions.edit', $item),
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
    public function show(ExamQuestion $examQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, ExamQuestion $examQuestion)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $statuses = ModelStatusEnum::toArray();
        $examPatterns = ExamPattern::with('type:id,name')
                        ->orderBy('name', 'desc')
                        ->where('status', ModelStatusEnum::PUBLISHED)
                        ->get(['id', 'name', 'exam_type_id']);
        $examDifficulties = ExamDifficulty::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examSubjects = ExamSubject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examAnswerTypes = ExamAnswerTypeEnum::toArray();
        return view('exam-questions.edit', [
            'item' => $examQuestion,
            'statuses' => $statuses,
            'examSubjects' => $examSubjects,
            'examPatterns' => $examPatterns,
            'examAnswerTypes' => $examAnswerTypes,
            'examDifficulties' => $examDifficulties,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ExamQuestion $examQuestion)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
            'exam_pattern_id' => [Rule::exists(ExamPattern::class, 'id')],
            'exam_subject_id' => [Rule::exists(ExamSubject::class, 'id')],
            'exam_difficulty_id' => [Rule::exists(ExamDifficulty::class, 'id')],
            'question' => ['nullable', 'string'],
            'answer1' => ['nullable', 'string'],
            'answer2' => ['nullable', 'string'],
            'answer3' => ['nullable', 'string'],
            'answer4' => ['nullable', 'string'],
            'correct_answer' => ['required', 'integer', 'between:1,4'],
            'solution' => ['nullable', 'string'],
        ]);

        try {
            $examQuestion->update($validated);
            return response()->json([
                'success'=> true,
                'message' => 'Saved successfully',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, ExamQuestion $examQuestion)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        try {
            $examQuestion->delete();
        } catch(Exception $e) {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
        return response()->json([
            'success'=> true,
            'reload' => true,
            'message'=> 'Deleted question'
        ]);
    }
}
