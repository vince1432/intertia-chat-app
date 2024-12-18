<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/messages', [MessageController::class, 'chats'])->name('home');
Route::post('/messages', [MessageController::class, 'messages'])->name('messages');
Route::post('/send', [MessageController::class, 'sendMessage'])->name('send');
Route::any('/{any?}', function () {
	return redirect(route('home'));
})->name('redirect');
