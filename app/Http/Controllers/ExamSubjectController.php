<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\ExamSubject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ExamSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ExamSubject::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exam-subjects.index', ['items'=> $items]);
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
        try {
            $item = ExamSubject::create([
                'name' => 'New subject',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('exam-subjects.edit', $item),
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
    public function show(ExamSubject $examSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamSubject $examSubject)
    {
        $statuses = ModelStatusEnum::toArray();
        return view('exam-subjects.edit', [
            'item'=> $examSubject,
            'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ExamSubject $examSubject)
    {
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
        ]);

        try {
            $examSubject->update($validated);
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
    public function destroy(ExamSubject $examSubject)
    {
        try {
            $examSubject->delete();
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
