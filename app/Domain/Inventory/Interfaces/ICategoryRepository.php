<?php

namespace App\Domain\Inventory\Interfaces;

use App\Domain\Inventory\Models\Category;
use App\Http\Resources\CategoryCollection;

interface ICategoryRepository
{
    public function createCategory(array $category): Category;

    public function findCategoryById(int $id): ?Category;

    public function getAllCategories(): CategoryCollection;
}
