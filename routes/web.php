<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/messages', [MessageController::class, 'chats'])->name('home');
Route::post('/messages', [MessageController::class, 'messages'])->name('messages');
Route::post('/send', [MessageController::class, 'sendMessage'])->name('send');
Route::any('/{any?}', function () {
	return redirect(route('home'));
})->name('redirect');
