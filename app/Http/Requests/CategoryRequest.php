<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class categoryRequest extends FormRequest
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
            'img' => 'required',
        ];
    }
    
    public function messages(){
        return [
            'name.required' => 'Category name is required',
            'name.string' => 'Category name must be a string',
            'description.required' => 'Category description is required',
            'description.string' => 'Category description must be a string',
            'img.required' => 'You must upload an image',
        ];
    }
}
