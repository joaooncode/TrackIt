<?php

namespace App\Http\Controllers\v1;

use App\Domain\Inventory\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
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

    }

    public  function store(StoreCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

       $category = $this->service->createCategory($validated);

       return response()->json([
          'message' => 'Categoria cadastrada com sucesso.',
          'data' => $category
       ], 201);
    }
}
