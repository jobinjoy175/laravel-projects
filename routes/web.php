<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StatisticsController;

Route::get('/welcome', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth')->name('events.create');
Route::post('/events', [EventController::class, 'store'])->middleware('auth')->name('events.store');
Route::post('/events/invite', [EventController::class, 'invite'])->middleware('auth')->name('events.invite');
Route::post('/events/remove-invite', [EventController::class, 'removeInvite'])->middleware('auth')->name('events.removeInvite');
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
