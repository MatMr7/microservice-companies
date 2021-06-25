<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    CategoryController,
    CompanyController
};

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

Route::apiResource('categories', CategoryController::class);

Route::apiResource('company', CompanyController::class);