<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//public routes
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

//logged users routes
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', 'AuthController@logout');
    
    Route::get('movies/', 'MovieController@index');
    Route::get('movies/{movie}', 'MovieController@show');
    Route::get('movieByTitle/', 'MovieController@getMoviesByTitle');

    Route::patch('like/', 'LikeController@like');

    Route::post('sale/', 'SaleController@sale');
    Route::post('rent/', 'RentController@rent');
});

Route::middleware(['jwt.verify','check.admin'])->prefix('admin')->group(function(){
    //movie endpoints
    Route::get('movies/', 'MovieController@indexAdmin');
    Route::post('movies', 'MovieController@store');
    Route::patch('movies/{movie}', 'MovieController@update');
    Route::patch('movies/availability/{movie}', 'MovieController@remove');
    Route::delete('movies/{movie}', 'MovieController@destroy');
    
    Route::patch('rent/return', 'RentController@returnRent');

    Route::patch('/user/toggleAdmin','AuthController@toggleAdmin');
});
