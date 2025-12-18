<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\LocaleController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('v1')->group(function () {
    // Translation routes
    Route::apiResource('translations', TranslationController::class)->except(['index']);
    Route::get('translations', [TranslationController::class, 'search']); // Search endpoint
    Route::get('translations/export/json', [TranslationController::class, 'export']); // JSON export
    
    // Locale routes
    Route::resource('locales', LocaleController::class); // Store locale
    
    // Tag routes
    Route::apiResource('tags', TagController::class);

})->middleware('auth:api');







