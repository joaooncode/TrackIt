<?php


use App\Http\Controllers\v1\CategoryController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)->group(function () {
    Route::get('/', 'index')->name('categories.index');
   Route::post('/create', 'store')->name('category.store');
   Route::get('/{category}', 'show')->name('category.show');
});
