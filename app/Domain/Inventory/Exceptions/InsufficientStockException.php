<?php

namespace App\Domain\Inventory\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InsufficientStockException extends \Exception
{
    protected $message = 'A quantidade solicitada excede o estoque disponível.';

    public function  render(Request $request): JsonResponse
    {
        return response()->json([

             'message' => $this->getMessage(),
            'error' => 'INSUFFICIENT_STOCK',
            'status' => 422
        ], 422);
    }
}
