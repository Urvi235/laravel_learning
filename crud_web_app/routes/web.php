<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 



Route::group(['middleware'=>['auth']], function() {
    Route::resource('movies',MoviesController::class);
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register',[AuthController::class, 'register'] );
Route::get('logout',[AuthController::class, 'logout'] );
Route::post('registerValidate',[AuthController::class, 'registerValidate'])->name('registerValidate');
Route::post('loginValidate',[AuthController::class, 'loginValidate'])->name('loginValidate');
