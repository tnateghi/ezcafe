<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    // ------------------ MainController
    Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');
    // ------------------ auth
    Route::any('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // ------------------ foods
    Route::resource('foods', FoodController::class);

    // ------------------ admins
    Route::resource('admins', AdminController::class);

    // ------------------ filemanager
    Route::get('filemanager', [FileManagerController::class, 'index'])->name('filemanager.index');
    Route::get('filemanager-iframe', [FileManagerController::class, 'iframe'])->name('filemanager.iframe');

    // ------------------ settings
    Route::get('settings', [MainController::class, 'settings'])->name('settings');
    Route::post('settings', [MainController::class, 'updateSettings']);

    Route::get('profile', [MainController::class, 'profile'])->name('profile');
    Route::put('profile', [MainController::class, 'updateProfile'])->name('profile.update');

    // ------------------ categories
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::post('categories/sort', [CategoryController::class, 'sort']);
    Route::post('category/slug', [CategoryController::class, 'generate_slug']);
});

// ------------------ auth
Route::middleware('admin.guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
