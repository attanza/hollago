<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\ChangePassword;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(UpdateProfile $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        $user->save();
        return response()->json($user);
    }

    public function changePassword(ChangePassword $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['msg' => 'User not found'], 400);
        }
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json(true, 200);
    }
}
