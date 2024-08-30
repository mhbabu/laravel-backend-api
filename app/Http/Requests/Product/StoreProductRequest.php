<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255|unique:products,title',
            'status'       => 'required|in:active,inactive',
            'categories'   => 'required|array',
            'categories.*' => 'exists:categories,id',
            'features'     => 'required|array',
            'features.*'   => 'string|max:255',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'The status must be either active or inactive.'
        ];
    }
}
