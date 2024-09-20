<?php
use App\Http\Controllers\pagesController;

Route::prefix('hospital')->group(function () {
    Route::get('dashboard', [pagesController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('user.index');
    Route::post('store', [pagesController::class, 'store'])->middleware(['auth', 'verified'])->name('plan.store');
    Route::get('view/{id}', [pagesController::class, 'view'])->middleware(['auth', 'verified'])->name('plan.view');
    Route::post('update/{id}', [pagesController::class, 'update'])->middleware(['auth', 'verified'])->name('plan.update');
});
