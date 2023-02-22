<?php

use App\Http\Controllers\api\AdminApiController;
use App\Http\Controllers\api\CampaignApiController;
use App\Http\Controllers\api\UserApiController;
use App\Models\campaign;
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

Route::post('admin/login', [AdminApiController::class, 'adminLoginAPI']); 
Route::group(['middleware' => ['auth:adminApi']], function () {
    Route::get('get/admin', [AdminApiController::class, 'getAdminDetails']);
    Route::post('create/user', [AdminApiController::class, 'createUser']);
});


// User Routes :
Route::post('user/login', [UserApiController::class, 'login']); 


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('get/user', [UserApiController::class, 'getUserDetail']);
    Route::post('change/password', [UserApiController::class, 'changePassword']);

    // Campaign Routes :
    Route::group(['prefix' => 'campaign'], function () {

        Route::post('/create', [CampaignApiController::class, 'createCampaign']);
        Route::post('/edit/{id}', [CampaignApiController::class, 'editCampaign']);
    });
});

