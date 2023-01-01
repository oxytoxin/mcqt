<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\McqtItemController;
use App\Http\Controllers\API\SourceController;
use App\Http\Controllers\API\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('sources', SourceController::class);

Route::get('categories/{category}/subcategories', [CategoryController::class, 'subcategories']);
Route::apiResource('categories', CategoryController::class);

Route::get('subcategories/{subcategory}/mcqt-items', [SubcategoryController::class, 'mcqt_items']);
Route::apiResource('subcategories', SubcategoryController::class);

Route::apiResource('mcqt-items', McqtItemController::class);
