<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth/redirect/{driver}', [\App\Http\Controllers\AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback/{driver}',  [\App\Http\Controllers\AuthController::class, 'callback'])->name('auth.callback');
Route::get('/auth/password',  [\App\Http\Controllers\AuthController::class, 'password'])->name('auth.password');
Route::post('/auth/set-password',  [\App\Http\Controllers\AuthController::class, 'setPassword'])->name('auth.set-password');

Route::middleware(['auth:sanctum', 'verified', 'password.empty'])->group(function () {
    Route::get('/', \App\Http\Livewire\Dashbaord\Index::class)->name('home');
    Route::get('/dashboard', \App\Http\Livewire\Dashbaord\Index::class)->name('dashboard');
    Route::get('/task', \App\Http\Livewire\Task\Index::class)->name('task');
});
