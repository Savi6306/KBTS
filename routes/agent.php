<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentTicketController;
use App\Http\Controllers\Agent\AgentProfileController;
Route::middleware('auth:agent')
    ->prefix('agent')
    ->name('agent.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AgentDashboardController::class, 'index'])
            ->name('dashboard');

        // Tickets list
        Route::get('/tickets', [AgentTicketController::class, 'index'])
            ->name('tickets.index');

        // Ticket details
        Route::get('/tickets/{ticket}', [AgentTicketController::class, 'show'])
            ->name('tickets.show');

        // Reply to ticket
        Route::post('/tickets/{ticket}/reply', [AgentTicketController::class, 'reply'])
            ->name('tickets.reply');

        // Update ticket status
        Route::post('/tickets/{ticket}/status', [AgentTicketController::class, 'changeStatus'])
            ->name('tickets.status');
            // Profile Page
    Route::get('/profile', [AgentProfileController::class, 'edit'])
        ->name('profile.edit');

    // Update Profile
    Route::post('/profile', [AgentProfileController::class, 'update'])
        ->name('profile.update');
});
