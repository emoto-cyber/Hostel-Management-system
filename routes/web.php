<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HostelManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', action: [HostelManagementController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'user_create'])->name('users.create');
    Route::post('/users', [UserController::class, 'user_store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'user_edit'])->name('users.edit');
    Route::put('/users/{id}/update', [UserController::class, 'user_update'])->name('users.update');
    Route::delete('/users/destroy', [UserController::class, 'user_destroy'])->name('users.destroy');
    Route::get('/roles/create', [RoleController::class, 'role_create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'role_store'])->name('roles.store');
    Route::get('/permissions/create', [PermissionController::class, 'permission_create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'permission_store'])->name('permissions.store');

    // });



    //hostel routes


Route::get('/hostel', [App\Http\Controllers\HostelManagementController::class, 'hostel_index'])->name('hostel.index');
 Route::get('/hostel/create', [App\Http\Controllers\HostelManagementController::class, 'hostel_create'])->name('hostel.create');
    Route::post('/hostel/store', [App\Http\Controllers\HostelManagementController::class, 'hostel_store'])->name('hostel.store');
    Route::delete('/hostel/destroy/{id}', [App\Http\Controllers\HostelManagementController::class, 'hostel_destroy'])->name('hostel.destroy');
    Route::get('/hostel/all', [App\Http\Controllers\HostelManagementController::class, 'hostel_all'])->name('hostel.all');

    //room routes
    Route::get('/room', [App\Http\Controllers\HostelManagementController::class,'room_index'])->name('room.index');
    Route::get('/room/create', [App\Http\Controllers\HostelManagementController::class,'room_create'])->name('room.create');
    Route::post('/room/store', [App\Http\Controllers\HostelManagementController::class,'room_store'])->name('room.store');
    Route::delete('/room/destroy/{id}', [App\Http\Controllers\HostelManagementController::class,'room_destroy'])->name('room.destroy');
    Route::get('/room/edit/{id}', [App\Http\Controllers\HostelManagementController::class,'room_edit'])->name('room.edit');
    Route::put('/room/update/{id}', [App\Http\Controllers\HostelManagementController::class,'room_update'])->name('room.update');
    Route::patch('/room/{id}/toggle', [App\Http\Controllers\HostelManagementController::class,'room_toggle'])->name('room.toggle');
    Route::get('/room/availble', [App\Http\Controllers\HostelManagementController::class,'room_available'])->name('room.available');
    Route::get('/room/occupied', [App\Http\Controllers\HostelManagementController::class,'room_occupied'])->name('room.occupied');


    //payment routes
    Route::get('/payments', [App\Http\Controllers\HostelManagementController::class,'payment_index'])->name('payment.index');
