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

// Route::get('noaccess', function () {
//     return view('auth.noaccess');
// });
Route::view('noaccess','auth.noaccess');

 

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register',[AuthController::class, 'register'] );
Route::get('movies',[AuthController::class,'validAuth']);
Route::get('dashboard',[AuthController::class,'userDetails'])->name('dashboard');
Route::get('logout',[AuthController::class, 'logout'] );
Route::post('loginValidate',[AuthController::class, 'loginValidate'])->name('loginValidate');
Route::post('registerValidate',[AuthController::class, 'registerValidate'])->name('registerValidate');
Route::get('user/details',[AuthController::class, 'userDetails'])->name('userDetails');
// Route::get('checkage',[AuthController::class, 'checkage']);


Route::middleware(['auth'])->group(function () {
    Route::resource('movies',MoviesController::class);

});

Route::group(['middleware' => ['auth', 'age']], function() {
    Route::resource('movies',MoviesController::class);


});


 