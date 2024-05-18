<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\Chapter;
use App\Models\Difficulty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        if ($currentUser->cannot('viewAny', Chapter::class)) {
            abort(403);
        }
        $items = Chapter::latest()->whereNull('parent_id')->orWhere('parent_id', '')->with('subject')->with('topics')->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('chapters.index', ['items' => $items]);
    }

    public function apiIndex(Request $req)
    {
        $subjectId = $req->subjectId;
        $chapterId = $req->chapterId;
        $items = [];
        if (!empty($subjectId)) {
            $items = Chapter::where('status', ModelStatusEnum::PUBLISHED)
                ->where('subject_id', $subjectId)
                ->whereNull('parent_id')
                ->orWhere('parent_id', '')
                ->get(['id', 'name']);
        } elseif( !empty($chapterId) ){
            $items = Chapter::where('status', ModelStatusEnum::PUBLISHED)
                ->where('parent_id', $chapterId)
                ->get(['id', 'name']);
        } else {
            $items = Chapter::where('status', ModelStatusEnum::PUBLISHED)
                        ->whereNull('parent_id')
                        ->orWhere('parent_id', '')
                        ->get(['id', 'name']);
        }
        return response()->json([
            'success' => true,
            'items' => $items,
        ]);
    }

    public function create(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', Chapter::class)) {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', Chapter::class)) {
            return response()->json(['message' => 'Forbidden'], 403);
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

    public function show(Request $req, Chapter $chapter)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', $chapter)) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, Chapter $chapter)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('update', $chapter)) {
            abort(403);
        }
        $statuses = ModelStatusEnum::toArray();
        $examSubjects = Subject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examDifficulties = Difficulty::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $chapters = Chapter::whereNull('parent_id')->orWhere('parent_id', '')->where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        return view('chapters.edit', [
            'item' => $chapter,
            'chapters' => $chapters,
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
        if ($currentUser->cannot('update', $chapter)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $req->merge(['slug' => Str::slug($req['slug'])]);
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Chapter::class)->ignore($chapter->id)],
            'subject_id' => [Rule::exists(Subject::class, 'id')],
            'parent_id' => ['nullable', Rule::exists(Chapter::class, 'id')],
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
        if ($currentUser->cannot('delete', $chapter)) {
            return response()->json(['message' => 'Forbidden'], 403);
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
