<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->controller(UserController::class)->group(function () {
	Route::get('/', 'index')->name('users.index');
	Route::get('/create', 'create')->name('users.create');
	Route::post('/', 'store')->name('users.store');
	Route::get('/edit/{user}', 'edit')->name('users.edit');
	Route::patch('/{user}', 'update')->name('users.update');
	Route::delete('/{user}', 'destroy')->name('users.destroy');
});

Route::get('/messages', [MessageController::class, 'chats'])->name('home');
Route::post('/messages', [MessageController::class, 'messages'])->name('messages');
Route::post('/send', [MessageController::class, 'sendMessage'])->name('send');
Route::any('/{any?}', function () {
	return redirect(route('home'));
})->name('redirect');
