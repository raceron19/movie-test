<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//public routes
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

//logged users routes
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', 'AuthController@logout');
});
