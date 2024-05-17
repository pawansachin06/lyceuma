<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\Chapter;
use App\Models\Difficulty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ChapterController extends Controller
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
        $items = Chapter::with('subject')->with('topics')->latest()->whereNull('parent_id')->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('chapters.index', ['items' => $items]);
    }

    public function apiIndex(Request $req)
    {
        $subjectId = $req->subjectId;
        $items = [];
        if( !empty($subjectId) ){
            $items = Chapter::with('topics')
                ->where('status', ModelStatusEnum::PUBLISHED)
                ->where('subject_id', $subjectId)
                ->get(['id', 'name', 'parent_id']);
        }
        return response()->json([
            'success'=> true,
            'items'=> $items,
        ]);
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
            $item = Chapter::create([
                'name' => '',
                'parent_id' => !empty($req->parent_id) ? $req->parent_id : '',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('chapters.edit', $item),
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
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, Chapter $chapter)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $statuses = ModelStatusEnum::toArray();
        $examSubjects = Subject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examDifficulties = Difficulty::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $chapters = Chapter::whereNull('parent_id')->where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        return view('chapters.edit', [
            'item' => $chapter,
            'chapters'=> $chapters,
            'statuses' => $statuses,
            'difficulties' => $examDifficulties,
            'subjects' => $examSubjects,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Chapter $chapter)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
            'subject_id' => [Rule::exists(Subject::class, 'id')],
            'difficulty_id' => [Rule::exists(Difficulty::class, 'id')],
        ]);

        try {
            $chapter->update($validated);
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
    public function destroy(Request $req, Chapter $chapter)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        try {
            $chapter->delete();
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
