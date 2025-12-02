<?php

namespace App\Domain\Inventory\Services;

use App\Domain\Inventory\Enums\MovementType;
use App\Domain\Inventory\Exceptions\InsufficientStockException;
use App\Domain\Inventory\Interfaces\IInventoryRepository;
use App\Domain\Inventory\Models\StockMovement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    protected IInventoryRepository $repository;

    public function __construct(IInventoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $productId
     * @param int $quantity
     * @param MovementType $type
     * @param string $reason
     * @return StockMovement
     * @throws InsufficientStockException
     */
    public function registerMovement(int $productId, int $quantity, MovementType $type, string $reason): StockMovement
    {
        $product = $this->repository->findProductById($productId);

        if (!$product) {
            throw new \Exception('Produto não encontrado.');
        }

        if ($type === MovementType::EXIT &&  !$product->hasSufficentStock($quantity)){
            throw new InsufficientStockException();
        }

        return DB::transaction(function () use ($product, $quantity, $type, $reason) {
            $movement = $this->repository->createMovement([
                'product_id' => $product->id,
                'user_id' =>Auth::id(),
                'type' => $type,
                'quantity' => $quantity,
                'reason' => $reason
            ]);

            $operation = ($type === MovementType::ENTRY) ? 'increment' : 'decrement';
            $this->repository->updateProductStock($product, $quantity, $operation);

            return $movement;
        });

    }
}
