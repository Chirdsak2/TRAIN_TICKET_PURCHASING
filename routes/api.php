<?php

use App\Http\Controllers\StationsController;
use App\Http\Controllers\TicketPriceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(StationsController::class)->group(function () {
    Route::get('/stations', 'index');
    Route::get('/stations/{id}', 'show');
    Route::post('/stations', 'store');
    Route::put('/stations/{id}', 'update'); // POSTMAN   KEY = _method , VALUR = 'PUT' เฉพาะ form-data
    Route::delete('/stations/{id}', 'destroy');
});

Route::controller(TicketPriceController::class)->group(function () {
    Route::get('/ticket-prices', 'index');
    Route::get('/ticket-prices/{id}', 'show');
    Route::post('/ticket-prices', 'store');
    Route::put('/ticket-prices/{id}', 'update'); 
    Route::delete('/ticket-prices/{id}', 'destroy');
});