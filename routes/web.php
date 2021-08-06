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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', \App\Http\Livewire\Dashbaord\Index::class)->name('home');
    Route::get('/dashboard', \App\Http\Livewire\Dashbaord\Index::class)->name('dashboard');
    Route::get('/task', \App\Http\Livewire\Task\Index::class)->name('task');
});
