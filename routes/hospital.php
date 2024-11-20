<?php
use App\Http\Controllers\pagesController;

Route::prefix('hospital')->group(function () {
    Route::get('dashboard', [pagesController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('user.index');
    Route::get('plan', [pagesController::class, 'plan'])->middleware(['auth', 'verified'])->name('plan.list');
    Route::get('plan/view/{id}', [pagesController::class, 'view'])->middleware(['auth', 'verified'])->name('plan.view');
    Route::post('store', [pagesController::class, 'store'])->middleware(['auth', 'verified'])->name('plan.store');
    Route::post('update/{id}', [pagesController::class, 'update'])->middleware(['auth', 'verified'])->name('plan.update');
    Route::post('update/log/{id}', [pagesController::class, 'updateLog'])->middleware(['auth', 'verified'])->name('plan.update.log');
});
