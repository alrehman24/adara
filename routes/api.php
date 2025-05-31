<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Front\HomePageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);


Route::group(['middleware' => 'auth:sanctum'], function () {
   Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/updateUser', [AuthController::class, 'updateUser']);

    Route::post('/auth/logout', function(){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    });

});
//front end data
Route::post('/getHomeData', [HomePageController::class, 'getHomeData']);
Route::get('/getHeaderCategoriesData', [HomePageController::class, 'getCategoriesData']);
