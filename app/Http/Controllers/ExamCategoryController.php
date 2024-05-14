<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use App\Models\ExamCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ExamCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ExamCategory::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-categories.index', ['items'=> $items]);
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
    public function show(ExamCategory $examCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamCategory $examCategory)
    {
        // $statuses = ModelStatusEnum::toArray();
        return view('exam-categories.edit', [
            'item'=> $examCategory,
            // 'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ExamCategory $examCategory)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'status' => [new Enum(ModelStatusEnum::class)],
        ]);

        try {
            $examCategory->update($validated);
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
    public function destroy(ExamCategory $examCategory)
    {
        //
    }
}
