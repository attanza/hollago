<?php

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::middleware(['auth'])->prefix('manage')->group(function () {
    /**
     * Dashboard
     */
    Route::get('/', function () {
        return view('manage.index');
    })->name('manage');
    /**
     * Profile
     */
    Route::get('/profile', 'ProfileController@index')->name('manage.profile');
    /**
     * Users
     */
    Route::get('/users', 'UserController@index')->name('manage.users')->middleware('permission:read-user');
    Route::get('/users/{id}', 'UserController@show')->name('manage.users')->middleware('permission:read-user');
});
