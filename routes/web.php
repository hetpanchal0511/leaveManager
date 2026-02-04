<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalLeaves = \App\Models\Leave::where('user_id', auth()->id())->count();
    $pendingLeaves = \App\Models\Leave::where('user_id', auth()->id())->where('status', 'pending')->count();
    $approvedLeaves = \App\Models\Leave::where('user_id', auth()->id())->where('status', 'approved')->count();
    $rejectedLeaves = \App\Models\Leave::where('user_id', auth()->id())->where('status', 'rejected')->count();
    
    return view('dashboard', compact('totalLeaves', 'pendingLeaves', 'approvedLeaves', 'rejectedLeaves'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Employee profile
    Route::get('/my-profile', [EmployeeController::class, 'myProfile'])->name('employee.profile');
    Route::patch('/my-profile', [EmployeeController::class, 'updateProfile'])->name('employee.profile.update');
    
    // Leave CRUD routes
    Route::resource('leaves', LeaveController::class);
});

// Admin routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/leaves', [AdminController::class, 'viewLeaves'])->name('admin.leaves.index');
    Route::get('/admin/leaves/{leave}', [AdminController::class, 'viewLeaveDetails'])->name('admin.leaves.show');
    Route::post('/admin/leaves/{leave}/approve', [AdminController::class, 'approveLeave'])->name('admin.leaves.approve');
    Route::post('/admin/leaves/{leave}/reject', [AdminController::class, 'rejectLeave'])->name('admin.leaves.reject');
    
    // Super admin only routes
    Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.users.index');
    Route::post('/admin/users/{user}/change-role', [AdminController::class, 'changeUserRole'])->name('admin.users.changeRole');
});

// Employee management routes
Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class);
});

require __DIR__.'/auth.php';

