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

        Route::get('me', 'me')->name('me')->middleware('auth:sanctum');
        Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
        Route::prefix('profile/')->as('profile.')->middleware('auth:sanctum')->group(function(){
            Route::post('edit', 'editProfile')->name('edit');
            Route::post('delete', 'deleteAccount')->name('delete');
            Route::post('change-password', 'changePassword')->name('change-password');
        });
    });
    Route::group(['controller' => 'ApiController'], function(){
        Route::get('home', 'home')->name('home');
        Route::get('products', 'products')->name('products');
    });
});
