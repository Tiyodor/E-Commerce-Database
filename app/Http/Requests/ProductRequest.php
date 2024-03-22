<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'details' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'category' => 'required|in:SD,EG,HG,RG,MG,PG,HI-RES,1/100',
            'price' => 'required',
        ];
    }
}
