<?php

use App\Http\Controllers\Api\Admin\BankController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\FacilityController;
use App\Http\Controllers\Api\Admin\FacilityHouseController;
use App\Http\Controllers\Api\Admin\HouseController;
use App\Http\Controllers\Api\Admin\ImagesHouseController;
use App\Http\Controllers\Api\Admin\InstallmentController;
use App\Http\Controllers\Api\Admin\InterestController;
use App\Http\Controllers\Api\Admin\MortgageRequestController;
use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [LoginController::class, 'index']);
Route::prefix('admin')->group(function(){
    Route::apiResource('cities', CityController::class);
    Route::apiResource('banks', BankController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('facilities', FacilityController::class);
    Route::apiResource('houses', HouseController::class);
    Route::apiResource('facilityhouse', FacilityHouseController::class);
    Route::apiResource('imagehouse', ImagesHouseController::class);
    Route::apiResource('interests', InterestController::class);
    Route::apiResource('mortgagerequests', MortgageRequestController::class);
    Route::apiResource('installments', InstallmentController::class);
    Route::post('/logout', [LoginController::class, 'logout']);
})->middleware('auth:api');
