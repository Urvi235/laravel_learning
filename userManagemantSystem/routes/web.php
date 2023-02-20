<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\user\CampaignController;
use App\Http\Controllers\user\UserAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
    if(auth()->check()) {
        return redirect()->route('dashboard'); 
    }
    return view('Auth.register');
});


    Route::get('/register', [UserAuthController::class, 'register']);
    Route::post('register/validate', [UserAuthController::class, 'registerValidate'])->name('registerValidate');
    Route::get('/login', [UserAuthController::class, 'userLogin'])->name('login');
    Route::post('/login/validate', [UserAuthController::class, 'loginValidate'])->name('loginValidate');
    Route::get('account/verify/{token}', [UserAuthController::class, 'verifyAccount'])->name('user.verify'); 


Route::group(['middleware' => ['prevent-back-history']], function() {
    Route::get('/logout',[UserAuthController::class, 'userLogout'] );

    // Route::group(['middleware' => ['auth','is_verify_email']], function() {
        Route::resource('campaign',CampaignController::class);
        Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    });

// });


Route::get('admin/login', [AdminController::class, 'adminLogin'])->name('adminLogin');
Route::get('admin/logout', [AdminController::class, 'adminLogout'])->middleware('prevent-back-history');
Route::post('admin/login/validate', [AdminController::class, 'validateAdminLogin'])->name('validateAdminLogin');
Route::post('create/user', [AdminController::class, 'createUser']);


Route::group(['middleware' => ['guest:admin', 'prevent-back-history']], function () {
    Route::get('admin/dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
});
