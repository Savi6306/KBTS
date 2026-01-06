<?php
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserTicketController;
use App\Http\Controllers\User\UserKbController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\HelpdeskController;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketReplyNotification;
use App\Notifications\TicketUpdated;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/agent.php';
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');
});


Route::middleware(['auth:web'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {


    // Dashboard AI Assistant
    Route::post('/ask-ai', [UserDashboardController::class, 'askAI'])
         ->name('askAI');
    // KB
    Route::get('/kb', [UserKbController::class,'index'])->name('kb.index');
    Route::get('/kb/{slug}', [UserKbController::class,'show'])->name('kb.show');
Route::post('/kb/rate/{id}', [UserKbController::class, 'rate'])
     ->name('kb.rate');

    // Tickets
    Route::get('/tickets', [UserTicketController::class,'index'])->name('tickets.index');
    Route::get('/tickets/create', [UserTicketController::class,'create'])->name('tickets.create');
    Route::post('/tickets', [UserTicketController::class,'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [UserTicketController::class,'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [UserTicketController::class,'reply'])->name('tickets.reply');

    // Profile
    //Route::get('/profile', [UserProfileController::class,'edit'])->name('profile.edit');
    //Route::post('/profile', [UserProfileController::class,'update'])->name('profile.update');
    Route::get('/profile', [UserProfileController::class, 'index'])
     ->name('profile');
});
Route::post('/ask', [\App\Http\Controllers\HelpdeskController::class, 'ask'])
    ->name('chatbot.ask');

//Route::post('/helpdesk/ask', [HelpdeskController::class, 'ask'])
   // ->name('helpdesk.ask');

//Route::get('/helpdesk/faqs', [HelpdeskController::class, 'faqs'])
    // ->name('helpdesk.faqs');

//Route::get('/helpdesk/search-kb', [HelpdeskController::class, 'searchKB'])
    // ->name('helpdesk.searchKB');
