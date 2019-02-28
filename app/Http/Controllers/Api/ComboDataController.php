<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComboDataController extends Controller
{
    public function index(Request $request)
    {
        $resources = ['Role'];
        $resource = $request->resource;
        if (!in_array($resource, $resources)) {
            return response()->json(['message' => 'Resource not found'], 400);
        }
        $model = "App\Models\\".$request->resource;
        $data = $model::select('id', 'name')
        ->where(function ($query) use ($resource) {
            if ($resource === 'Role') {
                $user = Auth::user();
                $isSuperUser = $user->hasRole('superuser');
                if (!$isSuperUser) {
                    $query->where('name', '<>', 'superuser');
                }
            }
        })
        ->orderBy('name', 'asc')
        ->get();
        return response()->json($data);
    }
}
