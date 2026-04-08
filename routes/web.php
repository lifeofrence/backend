<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\AdminLeadershipController;
use App\Http\Controllers\Admin\AdminCorporateActionController;
use App\Http\Controllers\Admin\AdminFinancialReportController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminKeyMaterialController;
use App\Http\Controllers\Admin\AdminPressReleaseController;
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

// Public Key Materials Serve Route
Route::get('/key-materials/{filename}', function (string $filename) {
    $path = storage_path('app/private/key_materials/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $disposition = request()->query('download') ? 'attachment' : 'inline';
    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => $disposition . '; filename="' . $filename . '"',
    ]);
})->where('filename', '.*\.pdf$')->name('key-materials.serve');

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
            Route::get('leadership/create', [AdminLeadershipController::class, 'create'])->name('leadership.create');
            Route::post('leadership', [AdminLeadershipController::class, 'store'])->name('leadership.store');
            Route::get('leadership/{leadership}/edit', [AdminLeadershipController::class, 'edit'])->name('leadership.edit');
            Route::match(['put', 'post'], 'leadership/{leadership}', [AdminLeadershipController::class, 'update'])->name('leadership.update');
            Route::delete('leadership/{leadership}', [AdminLeadershipController::class, 'destroy'])->name('leadership.destroy');
        });
    });

    // Corporate Actions
    Route::middleware(['role:Super Admin|Admin|Corporate Actions Manager|Viewer'])->group(function () {
        Route::get('corporate-actions', [AdminCorporateActionController::class, 'index'])->name('corporate-actions.index');
        Route::get('corporate-actions/{corporate_action}', [AdminCorporateActionController::class, 'show'])->name('corporate-actions.show');

        Route::middleware(['role:Super Admin|Admin|Corporate Actions Manager'])->group(function () {
            Route::get('corporate-actions/create', [AdminCorporateActionController::class, 'create'])->name('corporate-actions.create');
            Route::post('corporate-actions', [AdminCorporateActionController::class, 'store'])->name('corporate-actions.store');
            Route::get('corporate-actions/{corporate_action}/edit', [AdminCorporateActionController::class, 'edit'])->name('corporate-actions.edit');
            Route::match(['put', 'post'], 'corporate-actions/{corporate_action}', [AdminCorporateActionController::class, 'update'])->name('corporate-actions.update');
            Route::delete('corporate-actions/{corporate_action}', [AdminCorporateActionController::class, 'destroy'])->name('corporate-actions.destroy');
        });
    });

    // Financial Reports
    Route::middleware(['role:Super Admin|Admin|Financial Reports Manager|Viewer'])->group(function () {
        Route::get('financial-reports', [AdminFinancialReportController::class, 'index'])->name('financial-reports.index');

        Route::middleware(['role:Super Admin|Admin|Financial Reports Manager'])->group(function () {
            Route::get('financial-reports/create', [AdminFinancialReportController::class, 'create'])->name('financial-reports.create');
            Route::post('financial-reports', [AdminFinancialReportController::class, 'store'])->name('financial-reports.store');
            Route::get('financial-reports/{financial_report}/edit', [AdminFinancialReportController::class, 'edit'])->name('financial-reports.edit');
            Route::match(['put', 'post'], 'financial-reports/{financial_report}', [AdminFinancialReportController::class, 'update'])->name('financial-reports.update');
            Route::delete('financial-reports/{financial_report}', [AdminFinancialReportController::class, 'destroy'])->name('financial-reports.destroy');
        });
    });

    // Key Materials
    Route::middleware(['role:Super Admin|Admin|Key Materials Manager|Viewer'])->group(function () {
        Route::get('key-materials', [AdminKeyMaterialController::class, 'index'])->name('key-materials.index');

        Route::middleware(['role:Super Admin|Admin|Key Materials Manager'])->group(function () {
            Route::get('key-materials/create', [AdminKeyMaterialController::class, 'create'])->name('key-materials.create');
            Route::post('key-materials', [AdminKeyMaterialController::class, 'store'])->name('key-materials.store');
            Route::get('key-materials/{key_material}/edit', [AdminKeyMaterialController::class, 'edit'])->name('key-materials.edit');
            Route::match(['put', 'post'], 'key-materials/{key_material}', [AdminKeyMaterialController::class, 'update'])->name('key-materials.update');
            Route::delete('key-materials/{key_material}', [AdminKeyMaterialController::class, 'destroy'])->name('key-materials.destroy');
        });
    });

    // Press Releases
    Route::middleware(['role:Super Admin|Admin|Press Releases Manager|Viewer'])->group(function () {
        Route::get('press-releases', [AdminPressReleaseController::class, 'index'])->name('press-releases.index');

        Route::middleware(['role:Super Admin|Admin|Press Releases Manager'])->group(function () {
            Route::get('press-releases/create', [AdminPressReleaseController::class, 'create'])->name('press-releases.create');
            Route::post('press-releases', [AdminPressReleaseController::class, 'store'])->name('press-releases.store');
            Route::get('press-releases/{press_release}/edit', [AdminPressReleaseController::class, 'edit'])->name('press-releases.edit');
            Route::put('press-releases/{press_release}', [AdminPressReleaseController::class, 'update'])->name('press-releases.update');
            Route::delete('press-releases/{press_release}', [AdminPressReleaseController::class, 'destroy'])->name('press-releases.destroy');
        });
    });

    // Gallery
    Route::middleware(['role:Super Admin|Admin|Gallery Manager|Viewer'])->group(function () {
        Route::get('gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');

        Route::middleware(['role:Super Admin|Admin|Gallery Manager'])->group(function () {
            Route::get('gallery/create', [AdminGalleryController::class, 'create'])->name('gallery.create');
            Route::post('gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
            Route::get('gallery/{gallery}/edit', [AdminGalleryController::class, 'edit'])->name('gallery.edit');
            Route::match(['put', 'post'], 'gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
            Route::delete('gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
        });
    });

    // User management only for Super Admin
    Route::middleware(['role:Super Admin'])->group(function () {
        Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';