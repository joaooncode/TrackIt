<?php

use App\Http\Controllers\v1\ProductController;

Route::controller(ProductController::class)->group(function () {

    Route::get('/', 'index')
        ->name('product.index');
    
    Route::get('/{id}', 'show')
        ->name('product.show');

    Route::post('/', 'store')
        ->name('product.store');
});
