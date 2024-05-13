<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use App\Models\ExamType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ExamTypeController extends Controller
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
        $items = ExamType::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-types.index', ['items' => $items]);
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
            $item = ExamType::create([
                'name' => 'New exam type',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('exam-types.edit', $item),
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
    public function show(ExamType $examType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, ExamType $examType)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }

        $statuses = ModelStatusEnum::toArray();
        return view('exam-types.edit', [
            'item'=> $examType,
            'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ExamType $examType)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }

        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
        ]);

        try {
            $examType->update($validated);
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
    public function destroy(Request $req, ExamType $examType)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }

        try {
            $examType->delete();
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
