<?php
use App\Http\Controllers\cmpho\generalController;
use App\Http\Controllers\cmpho\userController;

Route::prefix('cmpho')->group(function () {
    Route::get('dashboard', [generalController::class, 'index'])->middleware(['auth', 'verified'])->name('cmpho.index');
    Route::get('view/{id}', [generalController::class, 'view'])->middleware(['auth', 'verified'])->name('cmpho.view');
    Route::post('update/{id}', [generalController::class, 'update'])->middleware(['auth', 'verified'])->name('cmpho.update');
    Route::post('update/log/{id}', [generalController::class, 'updateLog'])->middleware(['auth', 'verified'])->name('cmpho.update.log');
    Route::post('approve/{id}', [generalController::class, 'approve'])->middleware(['auth', 'verified'])->name('cmpho.approve');
});

Route::prefix('cmpho/users')->group(function () {
    Route::get('/', [userController::class, 'index'])->middleware(['auth', 'verified'])->name('cmpho.user.index');
    Route::post('/store', [userController::class, 'store'])->middleware(['auth', 'verified'])->name('cmpho.user.store');
    Route::post('/update/{id}', [userController::class, 'update'])->middleware(['auth', 'verified'])->name('cmpho.user.update');
    Route::get('/{id}', [userController::class, 'show'])->middleware(['auth', 'verified'])->name('cmpho.user.show');
});