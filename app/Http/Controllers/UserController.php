<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function icon($user)
    {
        if (!Uuid::isValid($user)) {
            abort(422);
        }

        try {
            $user = User::findOrFail($user);
            $file = $user->icon ? $user->icon : '/images/user.png';
            return response()->file(public_path($file));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function index(Request $request)
    {
        $offset = intval($request->input('start', 0));
        $users = User::select(['user_id', 'display_name'])
            ->offset(is_int($offset) ? $offset : 0)
            ->take(10)
            ->get();
        return view('user/index', ['users' => $users, 'title' => 'View User']);
    }

    public function create()
    {
        return view('user/create', ['title' => 'Create User']);
    }

    public function show($user)
    {
        try {
            if (!Uuid::isValid($user)) {
                abort(422);
            }
            $user = User::with('roles')->with('permissions')->findOrFail($user);
            return view('user/show', ['theUser' => $user]);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }
}