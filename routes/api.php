<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


// Grupo Base V1
Route::prefix('v1')->name('v1.')->group(function () {

    // 1. Health Check (Público)
    Route::get('/health', fn() => ['status' => 'ok']);

    // 2. Rotas Protegidas
    Route::middleware('auth:sanctum')->group(function () {

        // --- MÓDULO INVENTORY ---
        // Aqui definimos o prefixo "inventory" e carregamos o arquivo externo
        Route::prefix('inventory')
            ->name('inventory.')
            ->group(base_path('routes/v1/inventory.php'));

        // -- MÓDULO CATEGORY --

        Route::prefix('categories')
            ->name('categories.')
            ->group(base_path('routes/v1/category.php'));

        
        // -- MÓDULO PRODUCTS --

        Route::prefix('products')
            ->name('products.')
            ->group(base_path('routes/v1/product.php'));
    });
});

require __DIR__ . '/auth.php';
