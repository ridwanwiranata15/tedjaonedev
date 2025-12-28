<?php

use App\Http\Controllers\Api\Admin\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('admin')->group(function(){
    Route::apiResource('cities', CityController::class);
});
