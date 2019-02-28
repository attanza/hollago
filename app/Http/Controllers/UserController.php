<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show($id)
    {
        $user = User::with('roles')->where('uuid', $id)->firstOrFail();
        return view('users.show')->withUser($user);
    }
}
