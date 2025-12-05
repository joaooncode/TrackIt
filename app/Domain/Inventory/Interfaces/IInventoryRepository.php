<?php

namespace App\Domain\Inventory\Interfaces;

use App\Domain\Inventory\Models\Product;
use App\Domain\Inventory\Models\StockMovement;
use App\Http\Resources\ProductCollection;

interface IInventoryRepository
{
    public function findProductById(string $id): ?Product;

    public function createMovement(array $data): StockMovement;

    public function updateProductStock(Product $product, int $quantity, string $operation): void;

    public function createProduct(array $data): Product;

    public function getAllProducts(): ProductCollection;

    public function searchProducts(string $term, int $perPage = 15);

}
