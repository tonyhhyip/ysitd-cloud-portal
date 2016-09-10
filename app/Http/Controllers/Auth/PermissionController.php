<?php

namespace App\Http\Controllers\Auth;

use App\Auth\Permission\Exception\PermissionNotExistsException;
use App\Auth\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all(['id', 'name']);
        return view('user/permission/index', ['permissions' => $permissions, 'title' => 'Permission']);
    }

    public function show($permission)
    {
        try {
            Permission::findByName($permission);
            abort(200);
        } catch (PermissionNotExistsException $e) {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required'
        ]);

        try {
            Permission::create(['name' => $request->input('name')]);
            abort(201);
        } catch (\PDOException $e) {
            abort(409);
        }
    }

    public function destroy($permission)
    {
        if (Uuid::isValid($permission)) {
            Permission::destroy($permission);
            abort(200);
        } else {
            try {
                Permission::findByName($permission)->delete();
            } catch (ModelNotFoundException $e) {
                abort(404);
            }
        }
    }
}