<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MessageController::class, 'chats'])->name('home');
Route::post('/messages', [MessageController::class, 'messages'])->name('messages');
Route::any('{slug}', function () {
	return redirect(route('home'));
})->name('redirect');
