<?php
use App\Http\Controllers\cmpho\generalController;
use App\Http\Controllers\cmpho\userController;
use App\Http\Controllers\cmpho\hospitalController;
use App\Http\Controllers\cmpho\departmentController;
use App\Http\Controllers\cmpho\budgetController;

Route::prefix('cmpho')->group(function () {
    Route::get('dashboard', [generalController::class, 'index'])->middleware(['auth', 'verified'])->name('cmpho.index');
    Route::get('view/{id}', [generalController::class, 'view'])->middleware(['auth', 'verified'])->name('cmpho.view');
    Route::post('update/{id}', [generalController::class, 'update'])->middleware(['auth', 'verified'])->name('cmpho.update');
    Route::post('update/log/{id}', [generalController::class, 'updateLog'])->middleware(['auth', 'verified'])->name('cmpho.update.log');
    Route::post('approve/{id}', [generalController::class, 'approve'])->middleware(['auth', 'verified'])->name('cmpho.approve');
    Route::post('store', [generalController::class, 'store'])->middleware(['auth', 'verified'])->name('cmpho.store');
});

Route::prefix('cmpho/users')->group(function () {
    Route::get('/', [userController::class, 'index'])->middleware(['auth', 'verified'])->name('cmpho.user.index');
    Route::post('/store', [userController::class, 'store'])->middleware(['auth', 'verified'])->name('cmpho.user.store');
    Route::post('/update/{id}', [userController::class, 'update'])->middleware(['auth', 'verified'])->name('cmpho.user.update');
    Route::get('/{id}', [userController::class, 'show'])->middleware(['auth', 'verified'])->name('cmpho.user.show');
});

Route::prefix('cmpho/hospital')->group(function () {
    Route::get('/', [hospitalController::class, 'index'])->middleware(['auth', 'verified'])->name('cmpho.hospital.index');
    Route::get('/{id}', [hospitalController::class, 'show'])->middleware(['auth', 'verified'])->name('cmpho.hospital.show');
    Route::post('/store', [hospitalController::class, 'store'])->middleware(['auth', 'verified'])->name('cmpho.hospital.store');
    Route::post('/update/{id}', [hospitalController::class, 'update'])->middleware(['auth', 'verified'])->name('cmpho.hospital.update');
});

Route::prefix('cmpho/department')->group(function () {
    Route::get('/', [departmentController::class, 'index'])->middleware(['auth', 'verified'])->name('cmpho.department.index');
    Route::get('/{id}', [departmentController::class, 'show'])->middleware(['auth', 'verified'])->name('cmpho.department.show');
    Route::post('/store', [departmentController::class, 'store'])->middleware(['auth', 'verified'])->name('cmpho.department.store');
    Route::post('/update/{id}', [departmentController::class, 'update'])->middleware(['auth', 'verified'])->name('cmpho.department.update');
});

Route::prefix('cmpho/budget')->group(function () {
    Route::get('/', [budgetController::class, 'index'])->middleware(['auth', 'verified'])->name('cmpho.budget.index');
    Route::post('/store', [budgetController::class, 'store'])->middleware(['auth', 'verified'])->name('cmpho.budget.store');
    Route::get('/status/changed', [budgetController::class, 'changed'])->name('cmpho.budget.changed');
});