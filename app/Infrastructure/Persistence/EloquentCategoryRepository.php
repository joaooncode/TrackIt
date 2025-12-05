<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Inventory\Interfaces\ICategoryRepository;
use App\Domain\Inventory\Models\Category;
use App\Http\Resources\CategoryCollection;


class EloquentCategoryRepository implements ICategoryRepository
{

    public function createCategory(array $category): Category
    {
        return Category::create($category);
    }

    public function findCategoryById(string $id): ?Category
    {
        return Category::find($id);
    }

    public function getAllCategories(): CategoryCollection
    {
        $categories = Category::orderBy('name')->paginate();

        return new CategoryCollection($categories);
    }
}
