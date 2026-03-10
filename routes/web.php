<?php

use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EndpointConfigController;
use App\Http\Controllers\Admin\EndpointJsonOverrideController;
use App\Http\Controllers\Admin\EventCacheController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Webview\WebviewController;
use Illuminate\Support\Facades\Route;

// Root redirect to dashboard
Route::get('/', fn () => redirect()->route('admin.dashboard'));

// Breeze /dashboard shortcut - redirect to admin dashboard
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Breeze profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public WebView routes
Route::prefix('webview')->name('webview.')->group(function () {
    Route::get('/about-us', [WebviewController::class, 'aboutUs'])->name('about-us');
    Route::get('/contact-us', [WebviewController::class, 'contactUs'])->name('contact-us');
    Route::get('/account-closure', [WebviewController::class, 'accountClosure'])->name('account-closure');
    Route::get('/coming-soon', [WebviewController::class, 'comingSoon'])->name('coming-soon');
    Route::get('/shariah-advisor', [WebviewController::class, 'shariahAdvisor'])->name('shariah-advisor');
});

// Admin routes (auth-protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('services', ServiceController::class);
    Route::resource('pages', PageController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('endpoint-configs', EndpointConfigController::class)
        ->only(['index', 'show', 'edit', 'update']);

    // Endpoint JSON Overrides
    Route::prefix('endpoint-overrides')->name('endpoint-overrides.')->group(function () {
        Route::get('/', [EndpointJsonOverrideController::class, 'index'])->name('index');
        Route::get('/create', [EndpointJsonOverrideController::class, 'create'])->name('create');
        Route::post('/', [EndpointJsonOverrideController::class, 'store'])->name('store');
        Route::get('/{endpointOverride}/edit', [EndpointJsonOverrideController::class, 'edit'])->name('edit');
        Route::put('/{endpointOverride}', [EndpointJsonOverrideController::class, 'update'])->name('update');
        Route::post('/{endpointOverride}/preview', [EndpointJsonOverrideController::class, 'preview'])->name('preview');
        Route::post('/{endpointOverride}/reset', [EndpointJsonOverrideController::class, 'reset'])->name('reset');
    });

    // App Settings
    Route::get('/app-settings', [AppSettingController::class, 'index'])->name('app-settings.index');
    Route::put('/app-settings', [AppSettingController::class, 'update'])->name('app-settings.update');
    Route::post('/app-settings', [AppSettingController::class, 'store'])->name('app-settings.store');
    Route::delete('/app-settings/{appSetting}', [AppSettingController::class, 'destroy'])->name('app-settings.destroy');

    // Event Caches
    Route::get('/event-caches', [EventCacheController::class, 'index'])->name('event-caches.index');
    Route::delete('/event-caches/clear-all', [EventCacheController::class, 'destroyAll'])->name('event-caches.destroy-all');
    Route::delete('/event-caches/{eventCache}', [EventCacheController::class, 'destroy'])->name('event-caches.destroy');
});
