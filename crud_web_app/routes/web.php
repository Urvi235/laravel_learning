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
 

// Route::view('movies/noaccess','auth.noaccess');
// Route::view('movies/userPost','movies.userPost');

// Admin login routes : ---
Route::get('admin/login', [AdminController::class, 'adminIndex'])->name('adminlogin');
Route::get('admin/register', [AdminController::class, 'adminRegister'])->name('adminRegister');
Route::post('admin/validateAdminRegister', [AdminController::class, 'validateAdminRegister'])->name('validateAdminRegister');
Route::post('admin/validateAdminLogin',[AdminController::class, 'validateAdminLogin'])->name('validateAdminLogin');
// Route::get('admin/adminDashbord',[AdminController::class, 'adminDashbord'])->name('adminDashbord')->middleware('guest:admin');
Route::group(['middleware' => ['guest:admin']], function () {
    Route::get('admin/adminDashbord', [AdminController::class, 'adminDashbord'])->name('adminDashbord');
});


 
// user login routes : --- 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register',[AuthController::class, 'register'] );
Route::get('movies',[AuthController::class,'validAuth']);
Route::get('dashboard',[AuthController::class,'userDetails'])->name('dashboard')-> middleware('auth');
Route::get('/logout',[AuthController::class, 'logout'] );
Route::post('loginValidate',[AuthController::class, 'loginValidate'])->name('loginValidate');
Route::post('registerValidate',[AuthController::class, 'registerValidate'])->name('registerValidate');
Route::get('user/details',[AuthController::class, 'userDetails'])->name('userDetails');


// Movies route : ---
Route::get('movies/userPost/{id?}',[MoviesController::class, 'userAllPost'])->name('userAllPost');
Route::post('movies/comment/{id?}',[MoviesController::class, 'comment'])->name('comment');
Route::group(['middleware' => ['auth', 'age']], function() {
    Route::resource('movies',MoviesController::class);
});




