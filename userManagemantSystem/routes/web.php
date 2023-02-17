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
    return view('Auth.register');
});

// Route::group(['middleware' => ['verified']], function() {
    Route::get('/register', [UserAuthController::class, 'register']);
    Route::post('register/validate', [UserAuthController::class, 'registerValidate'])->name('registerValidate');
    Route::get('/login', [UserAuthController::class, 'userLogin'])->name('login');
    Route::post('/login/validate', [UserAuthController::class, 'loginValidate'])->name('loginValidate');
// });

Route::get('/logout',[UserAuthController::class, 'userLogout'] );


Route::group(['middleware' => ['auth','is_verify_email']], function() {
    Route::resource('campaign',CampaignController::class);
    Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
});



Route::get('admin/dashboard', [AdminController::class, 'adminDashboard']);
Route::get('account/verify/{token}', [UserAuthController::class, 'verifyAccount'])->name('user.verify'); 

