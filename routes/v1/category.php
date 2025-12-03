<?php


use App\Http\Controllers\v1\CategoryController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)->group(function () {
   Route::post('/create', 'store')->name('category.store');
});
