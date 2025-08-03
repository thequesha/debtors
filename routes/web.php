<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\TrimController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\DealStepController;
use App\Http\Controllers\UserController;
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

Route::view('/', 'index')->name('index');

// Authentication Routes
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login'])->name('loginPost');
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
// Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

// // SMS Verification Routes
// Route::get('sms/verify', [\App\Http\Controllers\Auth\SmsVerificationController::class, 'show'])->name('sms.verify.notice');
// Route::post('sms/verify', [\App\Http\Controllers\Auth\SmsVerificationController::class, 'verify'])->name('sms.verify');
// Route::post('sms/resend', [\App\Http\Controllers\Auth\SmsVerificationController::class, 'resend'])->name('sms.resend');

// // Password Reset Routes
// Route::get('password/forgot', [\App\Http\Controllers\Auth\SmsVerificationController::class, 'showForgotForm'])->name('password.request');
// Route::post('password/forgot', [\App\Http\Controllers\Auth\SmsVerificationController::class, 'forgotPassword'])->name('password.forgot');
// Route::get('password/reset', [\App\Http\Controllers\Auth\SmsVerificationController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [\App\Http\Controllers\Auth\SmsVerificationController::class, 'resetPassword'])->name('password.update');


// Route::middleware(['auth'])
    // ->group(function () {
        // Route::view('/', 'dashboard')->name('index');

        // Brand management (available to all authenticated users)

        // Admin only routes
        // Route::middleware(['auth', 'can:manage users'])->group(function () {
        //     // Users management
        //     Route::get('users/list', [UserController::class, 'list'])->name('users.list');
        //     Route::get('users', [UserController::class, 'index'])->name('users.index');
        //     Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        //     Route::post('users', [UserController::class, 'store'])->name('users.store');
        //     // Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        //     Route::get('users/{user}/edit', [UserController::class, 'edit'])->withTrashed()->name('users.edit');
        //     Route::put('users/{user}', [UserController::class, 'update'])->withTrashed()->name('users.update');
        //     Route::delete('users/{user}', [UserController::class, 'destroy'])->withTrashed()->name('users.destroy');
        // });
    // });
