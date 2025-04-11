<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('home');
Route::post('/', [TodoController::class, 'store'])->name('todo.store');
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
