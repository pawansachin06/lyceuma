<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use App\Models\ExamChapter;
use App\Models\ExamTopic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ExamTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ExamTopic::with('chapter')->latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-topics.index', ['items'=> $items]);
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
        try {
            $item = ExamTopic::create([
                'name' => '',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('exam-topics.edit', $item),
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
    public function show(ExamTopic $examTopic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamTopic $examTopic)
    {
        $statuses = ModelStatusEnum::toArray();
        $examChapters = ExamChapter::orderBy('name', 'desc')
            ->where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        return view('exam-topics.edit', [
            'item'=> $examTopic,
            'examChapters'=> $examChapters,
            'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ExamTopic $examTopic)
    {
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
            'exam_chapter_id' => [Rule::exists(ExamChapter::class, 'id')],
        ]);

        try {
            $examTopic->update($validated);
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
    public function destroy(ExamTopic $examTopic)
    {
        try {
            $examTopic->delete();
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
