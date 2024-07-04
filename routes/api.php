<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageMoveController;
use App\Http\Controllers\SupermarketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'test'], function() {
    Route::apiResource('packages', PackageController::class);
    // Route::apiResource('packages-moves', PackageMoveController::class);
    Route::apiResource('supermarkets', SupermarketController::class);
    Route::apiResource('audit-logs', AuditLogController::class);

    Route::get('/packages-moves', [PackageMoveController::class, 'index']);
    Route::get('/packages-moves/{packageMove}', [PackageMoveController::class, 'show']);

});