<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SubjectController extends Controller
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
        $items = Subject::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('subjects.index', ['items'=> $items]);
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
            $item = Subject::create([
                'name' => '',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('subjects.edit', $item),
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
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, Subject $subject)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        $statuses = ModelStatusEnum::toArray();
        return view('subjects.edit', [
            'item'=> $subject,
            'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Subject $subject)
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
            $subject->update($validated);
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
    public function destroy(Request $req, Subject $subject)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent()){
            abort(404);
        }
        try {
            $subject->delete();
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
