<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\ExamPattern;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ExamPatternController extends Controller
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
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        try {
            $item = ExamPattern::create([
                'name' => 'New pattern',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('exam-patterns.edit', $item),
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
    public function show(ExamPattern $examPattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, ExamPattern $examPattern)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $statuses = ModelStatusEnum::toArray();
        $examTypes = ExamType::get(['id', 'name']);
        return view('exam-patterns.edit', [
            'item'=> $examPattern,
            'statuses'=> $statuses,
            'examTypes'=> $examTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ExamPattern $examPattern)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
            'exam_type_id' => [Rule::exists(ExamType::class, 'id')],
        ]);

        try {
            $examPattern->update($validated);
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
    public function destroy(Request $req, ExamPattern $examPattern)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        try {
            $examPattern->delete();
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
