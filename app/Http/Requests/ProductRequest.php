<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|numeric|min:1',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'img' => 'required',
        ];
    }
    
    public function messages(){
        return [
            'name.required' => 'Product name is required',
            'name.string' => 'Product name must be a string',
            'description.required' => 'Product description is required',
            'description.string' => 'Product description must be a string',
            'category_id.required' => 'You must select a category',
            'category_id.min' => 'You must select a category',
            'img.required' => 'You must upload an image',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Quantity must be a number',
        ];
    }
}
