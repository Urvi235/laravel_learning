<?php

use App\Http\Controllers\api\AdminApiController;
use App\Http\Controllers\api\UserApiController;
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

// Admin Routes :
Route::post('create/user', [AdminApiController::class, 'createUser']);
Route::post('admin/login', [AdminApiController::class, 'adminLoginAPI']); 
Route::get('get/admin', [AdminApiController::class, 'getAdminDetails'])->middleware('auth:adminApi');


// User Routes :
Route::post('user/login', [UserApiController::class, 'login']); 
Route::get('get/user', [UserApiController::class, 'getUserDetail'])->middleware('auth:api');
Route::post('change/password', [UserApiController::class, 'changePassword'])->middleware('auth:api');
