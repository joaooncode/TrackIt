<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Inventory\Interfaces\IInventoryRepository;
use App\Domain\Inventory\Models\Product;
use App\Domain\Inventory\Models\StockMovement;
use App\Http\Resources\ProductCollection;

class EloquentInventoryRepository implements IInventoryRepository
{

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    public function findProductById(string $id): ?Product
    {
        return Product::with('category')->find($id);
    }

    public function createMovement(array $data): StockMovement
    {
        return StockMovement::create($data);
    }

    public function updateProductStock(Product $product, int $quantity, string $operation): void
    {
        if ($operation === 'increment') {
            $product->increment('stock_quantity', $quantity);
        } elseif ($operation === 'decrement') {
            $product->decrement('stock_quantity', $quantity);
        }
    }

    /**
     * Lista de produtos cadastrados no banco de dados.
     *
     * @return ProductCollection
     */
    public function getAllProducts(): ProductCollection
    {
        $products = Product::orderBy('name')->paginate();

        return new ProductCollection($products);
    }
}
