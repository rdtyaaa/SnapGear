<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Unit routes
Route::post('/units/{unit}/borrow', [UnitController::class, 'borrow'])->name('units.borrow');
Route::get('/admin/units/create', [AdminController::class, 'createUnit'])->name('admin.units.create');
Route::post('/admin/units', [AdminController::class, 'storeUnit'])->name('admin.units.store');
Route::get('/admin/units/{unit}/edit', [AdminController::class, 'editUnit'])->name('admin.units.edit');
Route::put('/admin/units/{unit}', [AdminController::class, 'updateUnit'])->name('admin.units.update');
Route::delete('/admin/units/{unit}', [AdminController::class, 'destroyUnit'])->name('admin.units.destroy');

// Category routes
Route::resource('categories', CategoryController::class);
Route::get('/admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
Route::get('/admin/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
Route::put('/admin/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

// User routes
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

// Member Routes
Route::get('/member', [MemberController::class, 'index'])->name('admin.member');

require __DIR__.'/auth.php';
