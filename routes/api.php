<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->namespace('Api')->group(function () {
    /**
     * PROFILE
     */
    Route::put('profile/{id}', 'ProfileController@update');
    Route::put('profile/{id}/change-password', 'ProfileController@changePassword');
    /**
     * Users
     */
    Route::get('users', 'UserController@index')->middleware('permission:read-user');
    Route::put('users/{id}', 'UserController@update')->middleware('permission:update-user');
    /**
     * Combo Data
     */
    Route::get('combo-data', 'ComboDataController@index');
});
