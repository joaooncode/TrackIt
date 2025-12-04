<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'message' => [
                'name' => $this->name,
                'description' => $this->description,
                'sku' => $this->sku,
                'price' => $this->price,
                'stockQuantity' => $this->stock_quantity,
                'minStockLevel' => $this->min_stock_level,
                'category' => new CategoryResource($this->whenLoaded('category')),
            ]
        ];
    }
}
