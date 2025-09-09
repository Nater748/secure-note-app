<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TrashController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [NoteController::class, 'home'])->name('home');
Route::post('/note', [NoteController::class, 'store'])->name('note.store');
Route::get('/notes', [NoteController::class, 'getNote'])->name('notes.index');
Route::get('/trash', [NoteController::class, 'trash'])->name('notes.trash');
Route::get('/notes/search', [NoteController::class, 'search'])->name('notes.search');
Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/note/{id}/edit', [NoteController::class, 'edit'])->name('note.edit');
Route::put('/note/{id}/update', [NoteController::class, 'update'])->name('note.update');
Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
Route::post('/notes/delete-all', [NoteController::class, 'deleteAll'])->name('notes.deleteAll');


Route::get('/trash', [TrashController::class, 'index'])->name('notes.trash');
Route::post('/trash/restore-all', [TrashController::class, 'restoreAll'])->name('trash.restoreAll');
Route::delete('/trash/empty-all', [TrashController::class, 'emptyTrash'])->name('trash.empty');
Route::get('/trash/search', [TrashController::class, 'search'])->name('trash.search');
Route::get('/trash/{id}', [TrashController::class, 'show'])->name('trash.show');
Route::post('/trash/{id}/restore', [TrashController::class, 'restore'])->name('trash.restore');
Route::delete('/trash/{id}', [TrashController::class, 'destroy'])->name('trash.destroy');