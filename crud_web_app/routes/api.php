<?php

use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\MoviesAPIController;
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


Route::group(['prefix' => 'movie'], function () { 
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/get/{id?}', [MoviesAPIController::class,'getMovies']);
        Route::post('/create', [MoviesAPIController::class,'create']);
        Route::put('/update/{id}', [MoviesAPIController::class,'update']);
        Route::delete('/delete/{id}', [MoviesAPIController::class,'delete']);
        Route::get('/get/user/posts', [MoviesAPIController::class,'getUserPosts']);
    });

});

Route::get('user/logout', [UserAuthController::class, 'userLogout'])->middleware('auth:api');

Route::post('user/login', [UserAuthController::class, 'userLogin']);