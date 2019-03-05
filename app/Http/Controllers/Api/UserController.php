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
        // sortBy=&descending=false&page=1&rowsPerPage=10&search=admin&totalItems=0&
        $rowsPerPage = $request->has('per_page') ? $request->per_page : 10;
        $sortBy = $request->sortBy ? $request->sortBy : 'name';
        $sortMode = $request->descending ? 'desc' : 'asc';
        $users = User::with('roles')->where(function ($query) use ($request) {
            if ($request->has('search')) {
                $query->where("name", "like", "%$request->search%")
                ->orWhere("email", "like", "%$request->search%")
                ->orWhere("phone", "like", "%$request->search%");
            }
        })->orderBy($sortBy, $sortMode)->paginate($rowsPerPage);
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
