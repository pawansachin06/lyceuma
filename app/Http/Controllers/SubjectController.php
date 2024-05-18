<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('viewAny', Subject::class)) {
            abort(403);
        }
        $items = Subject::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('subjects.index', ['items'=> $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', Subject::class)) {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', Subject::class)) {
            return response()->json(['message' => 'Forbidden'], 403);
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
    public function show(Request $req, Subject $subject)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', $subject)) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, Subject $subject)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('update', $subject)) {
            abort(403);
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
        if ($currentUser->cannot('update', $subject)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $req->merge(['slug' => Str::slug($req['slug']) ]);
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Subject::class)->ignore($subject->id)],
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
        if ($currentUser->cannot('delete', $subject)) {
            return response()->json(['message' => 'Forbidden'], 403);
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
