<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LeadershipMemberController;
use App\Http\Controllers\CorporateActionController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\GalleryItemController;

// Public routes
Route::get('leadership', [LeadershipMemberController::class, 'index']);
Route::get('corporate-actions', [CorporateActionController::class, 'index']);
Route::get('financial-reports', [FinancialReportController::class, 'index']);
Route::get('gallery', [GalleryItemController::class, 'index']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('leadership', LeadershipMemberController::class)->except(['index']);
    Route::apiResource('corporate-actions', CorporateActionController::class)->except(['index']);
    Route::apiResource('financial-reports', FinancialReportController::class)->except(['index']);
    Route::apiResource('gallery', GalleryItemController::class)->except(['index']);
});

// Auth route placeholder
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('admin-token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
