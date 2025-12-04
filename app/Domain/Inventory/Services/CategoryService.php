<?php

namespace App\Domain\Inventory\Services;

use App\Domain\Inventory\Interfaces\ICategoryRepository;
use App\Domain\Inventory\Models\Category;
use App\Domain\Shared\EntityNotFoundException;
use App\Http\Resources\CategoryCollection;


class CategoryService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(array $data): Category
    {
        return $this->categoryRepository->createCategory($data);
    }

    /**
     * @param string $id
     * @return Category
     * @throws EntityNotFoundException
     */
    public function findCategoryById(string $id): Category
    {
        $category = $this->categoryRepository->findCategoryById($id);

        if (!$category) {
            throw new EntityNotFoundException('Categoria', $id);
        }

        return $category;
    }

    public function getAllCategories(): CategoryCollection
    {
        return $this->categoryRepository->getAllCategories();
    }
}
