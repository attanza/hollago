<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfile;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(UpdateProfile $request, $id)
    {
        $user = Auth::user();
        $user->update($request->all());
        $user->save();
        return response()->json($user);
    }
}
