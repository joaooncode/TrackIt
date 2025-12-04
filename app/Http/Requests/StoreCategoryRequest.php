<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150', 'unique:categories,name'],
            'description' => ['string', 'max:150'],
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }
}
