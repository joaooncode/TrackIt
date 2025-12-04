<?php

namespace App\Http\Controllers\v1;

use App\Domain\Inventory\Models\Category;
use App\Domain\Inventory\Services\CategoryService;
use App\Domain\Shared\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAllCategories();

        return $categories;
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = $this->service->createCategory($validated);

        return response()->json([
            'message' => 'Categoria cadastrada com sucesso.',
            'data' => $category
        ], 201);
    }

    /**
     * Retorna uma categoria por ID
     *
     * @param integer $id
     * @return  CategoryResource
     * @throws EntityNotFoundException
     */
    public function show(int $id): CategoryResource
    {
        return new CategoryResource($this->service->findCategoryById($id));
    }
}
