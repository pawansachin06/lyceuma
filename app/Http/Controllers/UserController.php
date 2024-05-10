<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    public function __construct()
    {
    }


    public function index(Request $req)
    {
        $currentUser = $req->user();
        $query = User::query();
        if( $currentUser->isSuperAdmin() ){
        } else if( $currentUser->isAdmin() ){
            $query = $query->whereIn('role', [
                UserRoleEnum::EDITOR, UserRoleEnum::STUDENT
            ]);
        } else if( $currentUser->isEditor() ) {
            $query = $query->where('role', UserRoleEnum::STUDENT);
        } else if( $currentUser->isStudent() ) {
            $query = $query->where('id', $currentUser->id);
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        return view('users.index', ['items' => $items]);
    }


    public function create(Request $req)
    {
        $currentUser = $req->user();

        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
            return view('users.create', [
                'user_roles' => UserRoleEnum::toArray(),
            ]);
        }

        abort(403);
    }


    public function store(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
        } else {
            return response()->json([
                'message'=> 'Only allowed to admins'
            ], 403);
        }

        $req->merge(['email' => strtolower($req['email']) ]);
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique(User::class)],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'role' => [new Enum(UserRoleEnum::class)],
            'password' => ['string', 'max:26'],
        ]);

        if( $currentUser->isAdmin() ) {
            if( in_array($validated['role'], [
                UserRoleEnum::SUPERADMIN, UserRoleEnum::ADMIN
            ]) ){
                $validated['role'] = UserRoleEnum::EDITOR;
            }
        }

        if( $currentUser->isEditor() ){
            if( in_array($validated['role'], [
                UserRoleEnum::SUPERADMIN, UserRoleEnum::ADMIN, UserRoleEnum::EDITOR
            ]) ){
                $validated['role'] = UserRoleEnum::STUDENT;
            }
            $validated['referral_code'] = $currentUser->unique_code;
        }

        if( $currentUser->isStudent() ) {
            return response()->json([
                'message' => 'User creation not allowed to students',
            ], 422);
        }

        try {
            $item = User::create($validated);
            return response()->json([
                'success' => true,
                'redirect' => route('users.edit', $item->id),
                'message' => 'User created',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function show(User $user)
    {
        //
    }


    public function edit(Request $req, User $user)
    {
        $currentUser = $req->user();
        if( !in_array($currentUser->role, [
            UserRoleEnum::SUPERADMIN, UserRoleEnum::ADMIN
        ]) ){
            abort(403, 'Access denied');
        }
        return view('users.edit', [
            'item' => $user,
            'user_roles' => UserRoleEnum::toArray(),
        ]);
    }


    public function update(Request $req, User $user)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
        } else {
            return response()->json([
                'message'=> 'Only allowed to admins'
            ], 403);
        }

        $item = $user;
        $req->merge(['email' => strtolower($req['email']) ]);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique(User::class)->ignore($user->id)],
        ];

        if($currentUser->isSuperAdmin()){
            $rules['role'] = ['required', new Enum(UserRoleEnum::class)];
        } else {
            $validated['role'] = UserRoleEnum::STUDENT;
        }

        $validated = $req->validate($rules);

        try {
            $item->update($validated);
            return response()->json([
                'success' => true, 'message' => 'Saved successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false, 'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy(Request $req, User $user)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin()){
            if($currentUser->id == $user->id){
                return response()->json(['success'=> false, 'message'=> 'Can not deleted own super admin account']);
            } else {
                try {
                    $user->delete();
                } catch( Exception $e) {
                    return response()->json(['success' => false, 'message'=> $e->getMessage()]);
                }
                return response()->json(['success'=> true, 'reload' => true, 'message'=> 'Deleted user']);
            }
        }
        try {
            $user->delete();
        } catch(Exception $e){
            return response()->json(['success'=> false, 'message'=> $e->getMessage()]);
        }
        return response()->json(['success'=> true, 'reload' => true, 'message'=> 'Deleted user']);
    }
}
