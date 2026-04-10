<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LeadershipMemberController;
use App\Http\Controllers\CorporateActionController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\GalleryItemController;
use App\Http\Controllers\Api\KeyMaterialController;
use App\Http\Controllers\Api\PressReleaseController;

// Public routes
Route::get('leadership', [LeadershipMemberController::class, 'index']);
Route::get('corporate-actions', [CorporateActionController::class, 'index']);
Route::get('corporate-actions/{corporate_action}', [CorporateActionController::class, 'show']);
Route::get('financial-reports', [FinancialReportController::class, 'index']);
Route::get('gallery', [GalleryItemController::class, 'index']);
Route::get('key-materials', [KeyMaterialController::class, 'index']);
Route::get('key-materials/{key_material}', [KeyMaterialController::class, 'show']);
Route::get('press-releases', [PressReleaseController::class, 'index']);
Route::get('press-releases/{press_release}', [PressReleaseController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('leadership', LeadershipMemberController::class)->except(['index']);
    Route::apiResource('corporate-actions', CorporateActionController::class)->except(['index', 'show']);
    Route::apiResource('financial-reports', FinancialReportController::class)->except(['index']);
    Route::apiResource('gallery', GalleryItemController::class)->except(['index']);
    Route::apiResource('key-materials', KeyMaterialController::class)->except(['index', 'show']);
    Route::apiResource('press-releases', PressReleaseController::class)->except(['index', 'show']);
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
