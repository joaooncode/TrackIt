<?php

namespace App\Domain\Inventory\Services;

use App\Domain\Inventory\Interfaces\ICategoryRepository;
use App\Domain\Inventory\Models\Category;
use App\Domain\Shared\EntityNotFoundException;
use App\Http\Resources\CateogryCollection;


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
     * @param integer $id
     * @return Category
     * @throws EntityNotFoundException
     */
    public function findCategoryById(int $id): Category
    {
        $category = $this->categoryRepository->findCategoryById($id);

        if (!$category) {
            throw new EntityNotFoundException('Categoria', $id);
        }

        return $category;
    }

    public function getAllCategories(): CateogryCollection
    {
        return $this->categoryRepository->getAllCategories();
    }
}
