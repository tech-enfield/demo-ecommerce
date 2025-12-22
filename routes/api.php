<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['namespace' => 'App\Http\Controllers\API', 'as' => 'api.'], function () {
    Route::group(['controller' => 'AuthController'], function () {
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');

        Route::get('me', 'me')->name('me')->middleware('auth:api');
    });

});
