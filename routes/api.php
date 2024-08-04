<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index']);
Route::get('/create', [UserController::class, 'create']);
Route::get('/show/{id}', [UserController::class, 'show'])->whereNumber('id');
Route::get('/update/{id}', [UserController::class, 'update'])->whereNumber('id');
Route::get('/delete/{id}', [UserController::class, 'delete'])->whereNumber('id');
