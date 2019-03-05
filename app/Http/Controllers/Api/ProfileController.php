<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\ChangePassword;
use App\User;

class ProfileController extends Controller
{
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
            'password' => $request->password
        ]);
        $user->save();
        return response()->json(true, 200);
    }
}
