<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'sometimes|string|max:255|unique:products,title,' . $this->route('product')->id,
            'image'        => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories'   => 'sometimes|array',
            'categories.*' => 'exists:categories,id',
            'features'     => 'sometimes|array',
            'features.*'   => 'string|max:255'
        ];
    }
}
