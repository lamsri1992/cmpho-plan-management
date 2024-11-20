<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\cmpho\generalController;
use App\Http\Controllers\cmpho\userController;
use App\Http\Controllers\cmpho\hospitalController;
use App\Http\Controllers\cmpho\departmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [pagesController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/cmpho.php';
require __DIR__.'/hospital.php';
