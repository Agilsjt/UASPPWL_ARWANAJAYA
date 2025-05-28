<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
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

// Resource routes
Route::resource('employee', EmployeeController::class)->middleware('auth');
Route::resource('skill', SkillController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
Route::resource('perusahaan', PerusahaanController::class)->middleware('auth');

// Authentication routes
require __DIR__.'/auth.php';
