<?php

namespace App\Http\Requests;

use App\Domain\Inventory\Enums\MovementType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateStockMovementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'type' => ['required', new Enum(MovementType::class)],
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'type.Illuminate\Validation\Rules\Enum' => 'O tipo deve ser "in" (entrada) ou "out" (saída).',
            'product_id.exists' => 'O produto informado não existe.',
        ];
    }
}
