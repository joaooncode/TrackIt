<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku
                ];
            }),

            
            'meta' => [
                'total_count' => $this->collection->count(),
            ],
            'links' => [
                'self' => url()->current(),
            ],
        ];
    }
}
