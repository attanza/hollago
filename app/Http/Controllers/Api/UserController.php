<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->has('per_page') ? $request->per_page : 10;
        $sort_by = $request->has('sort_by') ? $request->sort_by : 'id';
        $sort_mode = $request->has('sort_mode') ? $request->sort_mode : 'desc';
        $users = User::with('roles')->where(function ($query) {
        })->orderBy($sort_by, $sort_mode)->paginate($per_page);
        return response()->json($users);
    }

    public function update(UpdateUser $request, $id)
    {
        $user = User::findOrFail($id);
        $body = $request->except(['role_id']);
        $user->update($body);
        $user->save();
        $user->roles()->sync([$request->role_id]);
        return response()->json($user);
    }
}
