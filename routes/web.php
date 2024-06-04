<?php

use App\Http\Controllers\StationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/stations', 'ApiStationsController@index');
// Route::get('/stations/{id}', 'ApiStationsController@show');

Route::controller(StationsController::class)->prefix('api')->group(function () {
    Route::get('/stations', 'index');
});



/// back