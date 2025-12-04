<?php

namespace App\Http\Controllers\v1;

use App\Domain\Inventory\Enums\MovementType;
use App\Domain\Inventory\Exceptions\InsufficientStockException;
use App\Domain\Inventory\Services\InventoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateStockMovementRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class InventoryController extends Controller
{

    protected InventoryService $service;

    public function __construct(InventoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Criar nova movimentação de estoque
     *
     * @param CreateStockMovementRequest $request
     * @return  JsonResponse
     * @throws InsufficientStockException
     */
    public function store(CreateStockMovementRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $movement = $this->service->registerMovement(
            productId: $validated['product_id'],
            quantity: $validated['quantity'],
            type: MovementType::from($validated['type']),
            reason: $validated['reason']
        );

        return response()->json([
            'message' => 'Movimentação registrada com sucesso!',
            'data' => $movement
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Novo produto
     *
     * Cria um novo registro de produto no banco de dados.
     *
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function createProduct(CreateProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $product = $this->service->createProduct($validated);

        return response()->json([
            'message' => "Produto " . $product->name . " registrado com sucesso!",
            'data' => $product
        ], 201);
    }

    public function findProductById(string $id): ProductResource
    {
        return new ProductResource($this->service->findProductById($id));
    }
}
