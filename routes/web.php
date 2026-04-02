<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\AdminLeadershipController;
use App\Http\Controllers\Admin\AdminCorporateActionController;
use App\Http\Controllers\Admin\AdminFinancialReportController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProfileController;

// Public PDF Serve Route (no auth required — publicly accessible)
Route::get('/reports/{filename}', function (string $filename) {
    $path = storage_path('app/private/reports/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $disposition = request()->query('download') ? 'attachment' : 'inline';
    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => $disposition . '; filename="' . $filename . '"',
    ]);
})->where('filename', '.*\.pdf$')->name('reports.serve');

// Public Gallery Image Serve Route
Route::get('/gallery/{filename}', function (string $filename) {
    $path = storage_path('app/private/gallery/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $mime = mime_content_type($path) ?: 'image/jpeg';
    return response()->file($path, ['Content-Type' => $mime]);
})->where('filename', '[^/]+')->name('gallery.serve');

// Public Leadership Image Serve Route
Route::get('/leadership/{filename}', function (string $filename) {
    $path = storage_path('app/private/leadership/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $mime = mime_content_type($path) ?: 'image/jpeg';
    return response()->file($path, ['Content-Type' => $mime]);
})->where('filename', '[^/]+')->name('leadership.serve');

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Panel Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Leadership
    Route::middleware(['role:Super Admin|Admin|Leadership Manager|Viewer'])->group(function () {
        Route::get('leadership', [AdminLeadershipController::class, 'index'])->name('leadership.index');
        Route::get('leadership/{leadership}', [AdminLeadershipController::class, 'show'])->name('leadership.show');
        Route::middleware(['role:Super Admin|Admin|Leadership Manager'])->group(function () {
            Route::resource('leadership', AdminLeadershipController::class)->except(['index', 'show']);
        });
    });

    // Corporate Actions
    Route::middleware(['role:Super Admin|Admin|Corporate Actions Manager|Viewer'])->group(function () {
        Route::get('corporate-actions', [AdminCorporateActionController::class, 'index'])->name('corporate-actions.index');
        Route::get('corporate-actions/{corporate_action}', [AdminCorporateActionController::class, 'show'])->name('corporate-actions.show');
        Route::middleware(['role:Super Admin|Admin|Corporate Actions Manager'])->group(function () {
            Route::resource('corporate-actions', AdminCorporateActionController::class)->except(['index', 'show']);
        });
    });

    // Financial Reports
    Route::middleware(['role:Super Admin|Admin|Financial Reports Manager|Viewer'])->group(function () {
        Route::get('financial-reports', [AdminFinancialReportController::class, 'index'])->name('financial-reports.index');
        Route::get('financial-reports/{financial_report}', [AdminFinancialReportController::class, 'show'])->name('financial-reports.show');
        Route::middleware(['role:Super Admin|Admin|Financial Reports Manager'])->group(function () {
            Route::resource('financial-reports', AdminFinancialReportController::class)->except(['index', 'show']);
        });
    });

    // Gallery
    Route::middleware(['role:Super Admin|Admin|Gallery Manager|Viewer'])->group(function () {
        Route::get('gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::get('gallery/{gallery}', [AdminGalleryController::class, 'show'])->name('gallery.show');
        Route::middleware(['role:Super Admin|Admin|Gallery Manager'])->group(function () {
            Route::resource('gallery', AdminGalleryController::class)->except(['index', 'show']);
        });
    });

    // User management only for Super Admin
    Route::middleware(['role:Super Admin'])->resource('users', AdminUserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';