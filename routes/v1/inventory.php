<?php

use App\Http\Controllers\v1\InventoryController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Rotas de Inventário
|--------------------------------------------------------------------------
|
| Este arquivo é carregado pelo routes/api.php dentro do grupo:
| prefixo: "api/v1/inventory"
| name: "v1.inventory."
| middleware: "auth:sanctum"
|
*/

Route::controller(InventoryController::class)->group(function () {

    // Rota final: POST /api/v1/inventory/movements
    // Nome final: v1.inventory.movements.store
    Route::post('/movements', 'store')->name('movements.store');

    // Produtos
    Route::post('/product/create', 'createProduct')->name('product.createProduct');
    Route::get('/product/{id}', 'findProductById')->name('product.findProductById');
});
