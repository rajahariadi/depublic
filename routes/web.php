<?php

use App\Http\Controllers\Customers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customers\TransactionController;
use App\Http\Controllers\GoogleController;
use App\Http\Middleware\AuthRedirectMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::group(['as' => 'customer.', 'middleware' => AuthRedirectMiddleware::class], function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware('auth')->group(function () {
        Route::get('/user/transactions/history', [TransactionController::class, 'bookingHistory'])->name('transactions.history');
        Route::get('/user/transactions/payment-detail/{transaction_id}', [TransactionController::class, 'paymentDetail'])->name('transactions.payment-detail');
        Route::get('/user/transactions/success/{transaction_id}', [TransactionController::class, 'success'])->name('transactions.success');
        Route::get('/user/transactions/failed/{transaction_id}', [TransactionController::class, 'failed'])->name('transactions.failed');
        Route::get('/user/transactions/see-details/{transaction_id}', [TransactionController::class, 'seeDetails'])->name('transactions.seeDetails');
    });

    Route::prefix('/events')->group(function () {

        Route::get('/', [EventController::class, 'events'])->name('events');
        Route::get('/search', [EventController::class, 'search'])->name('search');
        Route::get('/{slug}', [EventController::class, 'eventDetail'])->name('event-detail');


        Route::middleware('auth')->group(function () {

            Route::group(['prefix' => '{slug}/transaction', 'as' => 'transaction.'], function () {
                Route::get('/booking/{id}', [TransactionController::class, 'booking'])->name('booking');
                Route::post('/booking/process', [TransactionController::class, 'processBooking'])->name('processBooking');

                Route::get('/payment/{transaction_id}', [TransactionController::class, 'payment'])->name('payment');
                Route::post('/payment/process', [TransactionController::class, 'processPayment'])->name('processPayment');
            });
        });
    });
});
