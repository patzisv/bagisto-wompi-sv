<?php

use Illuminate\Support\Facades\Route;
use Kargo\WompiSV\Http\Controllers\RedirectController;
use Kargo\WompiSV\Http\Controllers\WebhookController;

Route::middleware(['web'])->group(function () {
    Route::get('/pagos/wompi/start', [RedirectController::class, 'start'])->name('wompisv.start');
    Route::get(config('wompisv.redirect_url'), [RedirectController::class, 'return'])->name('wompisv.return');
});

Route::post('/pagos/wompi/webhook', WebhookController::class)->name('wompisv.webhook');