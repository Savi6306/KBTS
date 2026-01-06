<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAgentController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminKbController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Login Page
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])
        ->name('login');

    // Login Submit
    Route::post('/login', [AdminLoginController::class, 'login'])
        ->name('login.post');

});

Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // Tickets
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])->name('tickets.status');
    Route::post('/tickets/{ticket}/assign', [AdminTicketController::class, 'assignAgent'])->name('tickets.assign');
Route::post('/tickets/{ticket}/reply', [AdminTicketController::class, 'reply'])
    ->name('tickets.reply');

    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Agents
    Route::get('/agents', [AdminAgentController::class, 'index'])->name('agents.index');
    Route::get('/agents/create', [AdminAgentController::class, 'create'])->name('agents.create');
    Route::post('/agents', [AdminAgentController::class, 'store'])->name('agents.store');
    Route::get('/agents/{user}', [AdminAgentController::class, 'show'])->name('agents.show');

    Route::get('/agents/{user}/edit', [AdminAgentController::class, 'edit'])->name('agents.edit');
    Route::post('/agents/{user}', [AdminAgentController::class, 'update'])->name('agents.update');
    Route::delete('/agents/{user}', [AdminAgentController::class, 'destroy'])->name('agents.destroy');

    // Categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])
    ->name('categories.update');

    //Route::post('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Knowledge Base
    Route::get('/kb', [AdminKbController::class, 'index'])->name('kb.index');
    Route::get('/kb/create', [AdminKbController::class, 'create'])->name('kb.create');
    Route::post('/kb', [AdminKbController::class, 'store'])->name('kb.store');
    Route::get('/kb/{article}/edit', [AdminKbController::class, 'edit'])->name('kb.edit');
    //Route::post('/kb/{article}', [AdminKbController::class, 'update'])->name('kb.update');
    //Route::put('/kb/{article}', [AdminKbController::class, 'update']);
Route::put('/kb/{article}', [AdminKbController::class, 'update'])->name('kb.update');

    Route::delete('/kb/{article}', [AdminKbController::class, 'destroy'])->name('kb.destroy');
});
Route::middleware('auth:admin')->group(function () {

    Route::get('/admin/profile', [\App\Http\Controllers\Admin\AdminProfileController::class, 'index'])
        ->name('admin.profile');

    Route::post('/admin/profile/update', [\App\Http\Controllers\Admin\AdminProfileController::class, 'update'])
        ->name('admin.profile.update');
});
