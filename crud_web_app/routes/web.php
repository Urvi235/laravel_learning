<?php

use App\Http\Controllers\AdminController;
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

// Admin login routes : ---
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'adminIndex'])->name('adminlogin');
    Route::get('/register', [AdminController::class, 'adminRegister'])->name('adminRegister');
    Route::post('/validate/admin/register', [AdminController::class, 'validateAdminRegister'])->name('validateAdminRegister');
    Route::post('/validate/admin/login',[AdminController::class, 'validateAdminLogin'])->name('validateAdminLogin');  
});


// user login routes : --- 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register',[AuthController::class, 'register'] );
Route::get('movies',[AuthController::class,'validAuth']);

Route::post('loginValidate',[AuthController::class, 'loginValidate'])->name('loginValidate');
Route::post('registerValidate',[AuthController::class, 'registerValidate'])->name('registerValidate');



Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/logout', [AdminController::class, 'adminLogout']);

        Route::group(['middleware' => ['guest:admin']], function () {
            Route::get('/dashbord', [AdminController::class, 'adminDashbord'])->name('adminDashbord');
            Route::delete('/delete/user/{id?}', [AdminController::class, 'deleteUser'])->name('deleteUser');
            Route::get('/show/user/details/{id?}', [AdminController::class, 'showUserDetail'])->name('showUserDetail');
        });
    });

    Route::get('dashboard',[AuthController::class,'userDetails'])->name('dashboard')-> middleware('auth');
    Route::get('user/details',[AuthController::class, 'userDetails'])->name('userDetails');
    Route::get('/logout',[AuthController::class, 'logout'] );


    // Movies route : ---
    Route::get('movies/userPost/{id?}',[MoviesController::class, 'userAllPost'])->name('userAllPost');
    Route::post('movies/comment/{id?}',[MoviesController::class, 'comment'])->name('comment');
    
    Route::group(['middleware' => ['auth', 'age']], function() {
        Route::resource('movies',MoviesController::class);
    });
});
