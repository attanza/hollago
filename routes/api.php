<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function () {
    Route::put('profile/{id}', 'ProfileController@update');
    Route::put('profile/{id}/change-password', 'ProfileController@changePassword');
});
