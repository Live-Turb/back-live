<?php

use App\Http\Controllers\Analytics\ViewsController;

Route::middleware(['auth'])->group(function () {
    Route::get('/analytics/views', [ViewsController::class, 'index'])->name('analytics.views');
    Route::get('/analytics/views/data', [ViewsController::class, 'getViewsData'])->name('analytics.views.data');
});
