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
            'title'        => 'required|string|max:255|unique:products,title,' . $this->route('product')->id,
            // 'status'       => 'required|in:active,inactive',
            // 'categories'   => 'required|array',
            // 'categories.*' => 'exists:categories,id',
            // 'features'     => 'required|array',
            // 'features.*'   => 'string|max:255',
           'image'         => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'status.in' => 'The status must be either active or inactive.'
    //     ];
    // }

    // protected function prepareForValidation()
    // {
       
    //     $categories = $this->input('categories');
    //     if (is_string($categories)) {
    //         $categoriesArray = array_map('trim', explode(',', $categories));
    //         $this->merge(['categories' => $categoriesArray]);
    //     }

    //     $features = $this->input('features');
    //     if (is_string($features)) {
    //         $featuresArray = array_map('trim', explode(',', $features));
    //         $this->merge(['features' => $featuresArray]);
    //     }
    // }
}
