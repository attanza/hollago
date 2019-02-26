<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->prefix('manage')->group(function () {
    Route::get('/', function () {
        return view('manage.index');
    })->name('manage');

    Route::get('/profile', 'ProfileController@index')->name('manage.profile');
});
