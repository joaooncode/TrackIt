<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Inventory\Interfaces\ICategoryRepository;
use App\Domain\Inventory\Models\Category;
use App\Http\Resources\CateogryCollection;


class EloquentCategoryRepository implements ICategoryRepository
{

    public function createCategory(array $category): Category
    {
        return Category::create($category);
    }

    public function findCategoryById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function getAllCategories(): CateogryCollection
    {
        $categories = Category::orderBy('name')->paginate();

        return new CateogryCollection($categories);
    }


}
