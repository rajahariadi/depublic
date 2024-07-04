<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/dt', [DashboardController::class, 'dtDashboard'])->name('dashboard.dt');
    Route::get('/event-categories/dt', [EventCategoryController::class, 'dtEventCategory'])->name('event-categories.dt');
    Route::get('/events/dt', [EventController::class, 'dtEvent'])->name('events.dt');
    Route::get('/tickets/dt', [TicketController::class, 'dtTickets'])->name('tickets.dt');
    Route::get('/users/dt', [UserController::class, 'dtUser'])->name('users.dt');
    Route::get('/transaction/dt', [TransactionsController::class, 'dtTransaction'])->name('transactions.dt');
    Route::post('/transaction/reject/{id}', [TransactionsController::class, 'rejectTransaction'])->name('transactions.reject');
    Route::post('/transaction/complete/{id}', [TransactionsController::class, 'completeTransaction'])->name('transactions.complete');

    Route::resources([
        'event-categories' => EventCategoryController::class,
        'events' => EventController::class,
        'tickets' => TicketController::class,
        'transactions' => TransactionsController::class,
        'users' => UserController::class,
    ]);

    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

