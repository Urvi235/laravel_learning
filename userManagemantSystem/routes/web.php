<?php

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

// Route::get('/', function () {
//     return view('Auth.register');
// });


Route::get('/', [UserAuthController::class, 'register']);
Route::post('register/validate', [UserAuthController::class, 'registerValidate'])->name('registerValidate');

Route::get('/login', [UserAuthController::class, 'userLogin']);


// Route::get('/email/verify', function () {
//     return view('Auth.verify-email');
// })->name('verification.notice');