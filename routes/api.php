<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\DocumentRequestController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\OfficialController;
use App\Http\Controllers\Api\UserController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public access to announcements and officials
Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show']);
Route::get('/officials', [OfficialController::class, 'index']);
Route::get('/officials/{official}', [OfficialController::class, 'show']);

// Document tracking (public)
Route::post('/documents/track', [DocumentRequestController::class, 'track']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::put('/change-password', [AuthController::class, 'changePassword']);

    // Complaints
    Route::apiResource('complaints', ComplaintController::class);

    // Document Requests
    Route::apiResource('documents', DocumentRequestController::class);

    // Announcements (admin only for create, update, delete)
    Route::apiResource('announcements', AnnouncementController::class)->except(['index', 'show']);

    // Officials (admin only for create, update, delete)
    Route::apiResource('officials', OfficialController::class)->except(['index', 'show']);

    // Users (admin only)
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/stats', [UserController::class, 'stats']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });
});
