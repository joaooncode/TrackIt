<?php

namespace App\Http\Controllers\v1;

use App\Domain\Inventory\Services\InventoryService;
use App\Domain\Shared\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected InventoryService $service;

    public function __construct(InventoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista de produtos
     *
     * Retorna os produtos cadastradso. Suporta busca por nome e sku do produto, passando query parameter 'q?'
     *
     * @param Request $request
     * @return ProductCollection
     */
    public function index(Request $request): ProductCollection
    {
        return new ProductCollection($this->service->getAllProducts($request));
    }

    /**
     * Exibe um produto especifico por ID
     *
     * @param string $id
     * @return  ProductResource
     * @throws EntityNotFoundException
     */
    public function show(string $id): ProductResource
    {
        return new ProductResource($this->service->findProductById($id));
    }

    /**
     * Registra um novo produto no bacno de dados
     *
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $product = $this->service->createProduct($validated);

        return response()->json([
            'message' => "Produto " . $validated['name'] . " cadastrado com sucesso!",
            'data' => $product
        ], 201);
    }

    /**
     * Atualiza um produto no banco de dados
     *
     * @param CreateProductRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(CreateProductRequest $request, string $id): JsonResponse
    {
        // TODO:Implementar edição de produtos
    }
}
