<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Inventory\Interfaces\IInventoryRepository;
use App\Domain\Inventory\Models\Product;
use App\Domain\Inventory\Models\StockMovement;

class EloquentInventoryRepository implements IInventoryRepository
{

    public function findProductById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function createMovement(array $data): StockMovement
    {
        return StockMovement::create($data);
    }

    public function updateProductStock(Product $product, int $quantity, string $operation): void
    {
        if ($operation === 'incremente') {
            $product->increment('stock_quantity', $quantity);
        } elseif ($operation === 'decremente') {
            $product->decrement('stock_quantity', $quantity);
        }
    }
}
