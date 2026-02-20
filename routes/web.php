<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLeadershipController;
use App\Http\Controllers\Admin\AdminCorporateActionController;
use App\Http\Controllers\Admin\AdminFinancialReportController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Panel Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Leadership
    Route::middleware(['role:Super Admin|Admin|Leadership Manager'])->resource('leadership', AdminLeadershipController::class)->except(['index', 'show']);
    Route::middleware(['role:Super Admin|Admin|Leadership Manager|Viewer'])->resource('leadership', AdminLeadershipController::class)->only(['index', 'show']);

    // Corporate Actions
    Route::middleware(['role:Super Admin|Admin|Corporate Actions Manager'])->resource('corporate-actions', AdminCorporateActionController::class)->except(['index', 'show']);
    Route::middleware(['role:Super Admin|Admin|Corporate Actions Manager|Viewer'])->resource('corporate-actions', AdminCorporateActionController::class)->only(['index', 'show']);

    // Financial Reports
    Route::middleware(['role:Super Admin|Admin|Financial Reports Manager'])->resource('financial-reports', AdminFinancialReportController::class)->except(['index', 'show']);
    Route::middleware(['role:Super Admin|Admin|Financial Reports Manager|Viewer'])->resource('financial-reports', AdminFinancialReportController::class)->only(['index', 'show']);

    // Gallery
    Route::middleware(['role:Super Admin|Admin|Gallery Manager'])->resource('gallery', AdminGalleryController::class)->except(['index', 'show']);
    Route::middleware(['role:Super Admin|Admin|Gallery Manager|Viewer'])->resource('gallery', AdminGalleryController::class)->only(['index', 'show']);

    // User management only for Super Admin
    Route::middleware(['role:Super Admin'])->resource('users', AdminUserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';