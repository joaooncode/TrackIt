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


        // --- MÓDULO AUTH (Exemplo futuro) ---
        // Route::prefix('auth')
        //     ->group(base_path('routes/api/v1/auth.php'));

    });
});
