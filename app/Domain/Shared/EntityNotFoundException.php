<?php

namespace App\Domain\Shared;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EntityNotFoundException extends \Exception
{
    public function __construct(string $entityName, $id = null)
    {

        $message = $id
            ?"{$entityName} com ID {$id} não foi encontrado(a)." : "{$entityName} solicitado(a) não foi encontrado(a).";

        parent::__construct($message);
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => 'RESOURCE_NOT_FOUND',
            'message' => $this->getMessage(),
            'code' => 404
        ],404);
    }
}
