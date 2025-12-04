<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'sku' => ['required', 'string', 'max:255', 'unique:products'],
            'description' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'stock_quantity' => ['required', 'integer'],
            'min_stock_level' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'O campo ID da categoria deve ser preenchido.',
            'category_id.exists' => 'Categoria selecionada não encontrada.',
            'name.required' => 'O campo nome do produto deve ser preenchido.',
            'name.unique' => 'Nome do produto já cadastrado.',
            'sku.required' => 'O campo SKU deve ser preenchido.',
            'sku.unique' => 'SKU já cadastrado.',
            'stock_quantity.required' => 'A quantidade de estoque do produto deve ser preenchido.',
            'stock_quantity.integer' => 'O campo quantidade de estoque do produto deve ser inteiro.',
            'min_stock_level.required' => 'O campo quantidade minima de estoque do produto deve ser preenchido. ',
            'min_stock_level.min' => 'Quantide minima de estoque deve ser pelo menos 1.'
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }
}
