<?php

use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InvitationController::class, 'index'])->name('invitation');
Route::post('/wedding', [InvitationController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('wish.store');