<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageMoveController;
use App\Http\Controllers\SupermarketController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');


// Routes accessible to both 'admin' role and 'employee' role
Route::middleware(['auth:sanctum', 'role:employee,admin'])->group(function () {
    //Packages
    Route::get('packages', [PackageController::class, 'index']);
    Route::get('packages/{package}', [PackageController::class, 'show']);
    Route::post('packages', [PackageController::class, 'store']);
    Route::put('packages/{package}', [PackageController::class, 'update']);
    Route::patch('packages/{package}', [PackageController::class, 'update']);

    //Supermarkets
    Route::get('supermarkets', [SupermarketController::class, 'index']);
    Route::get('supermarkets/{supermarket}', [SupermarketController::class, 'show']);
    Route::post('supermarkets', [SupermarketController::class, 'store']);
    Route::put('supermarkets/{supermarket}', [SupermarketController::class, 'put']);
    Route::patch('supermarkets/{supermarket}', [SupermarketController::class, 'patch']);

    //Package moves
    Route::get('/packages-moves', [PackageMoveController::class, 'index']);
    Route::get('/packages-moves/{packageMove}', [PackageMoveController::class, 'show']);
    Route::post('/packages-moves', [PackageMoveController::class, 'store']);
    Route::put('/packages-moves/{packageMove}', [PackageMoveController::class, 'update']);
    Route::patch('/packages-moves/{packageMove}', [PackageMoveController::class, 'update']);
});

// Routes accessible to 'admin' role only
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    
    Route::delete('users/{user}', [UserController::class, 'destroy']);
    Route::delete('packages/{package}', [PackageController::class, 'destroy']);
    Route::delete('supermarkets/{supermarket}', [SupermarketController::class, 'destroy']);
    Route::delete('packages-moves/{packageMove}', [PackageMoveController::class, 'destroy']);
    Route::delete('packages/{package}', [PackageController::class, 'destroy']);
    Route::delete('supermarkets/{supermarket}', [SupermarketController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});