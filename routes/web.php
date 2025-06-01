<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LayananController;
use Illuminate\Support\Facades\Route;

// Route homepage
Route::get('/', function () {
    return view('welcome')->with('title', 'Welcome');
})->name('home');

// Dashboard route protected by auth and email verification middleware
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes group with 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Role-based access
Route::middleware(['auth'])->group(function () {
    
    // Admin: full access
    Route::middleware(['auth', 'checkrole:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('skills', SkillController::class);
        Route::resource('layanans', LayananController::class);
        Route::resource('perusahaans', PerusahaanController::class);
    });

    // Staff: read-only
    Route::middleware(['auth', 'checkrole:staff'])->group(function () {
        Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('skills', [SkillController::class, 'index'])->name('skills.index');
        Route::get('layanans', [LayananController::class, 'index'])->name('layanans.index');
    });
});

Route::get('/test-middleware', function () {
    return 'Middleware test OK';
})->middleware('testmiddleware');

Route::get('/test-role', function () {
    return 'Test Role Middleware';
})->middleware('checkrole:admin');

// Authentication routes
require __DIR__.'/auth.php';
