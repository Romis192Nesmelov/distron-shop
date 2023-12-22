<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(BaseController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(FeedbackController::class)->group(function () {
//    Route::post('/feedback', 'feedback')->name('feedback');
    Route::post('/feedback-short', 'feedbackShort')->name('feedback_short');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::get('/confirmation-register/{slug}', 'confirmationRegister')->name('confirmation_register');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(AccountController::class)->middleware(['auth'])->group(function () {
    Route::get('/account', 'account')->name('account');
    Route::post('/edit-account', 'editAccount')->name('edit_account');
});
