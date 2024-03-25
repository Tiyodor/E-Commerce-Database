<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change this according to your authorization logic
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
            'address' => 'required',
            'product' => ['required', function ($attribute, $value, $fail) {
                // Get array of valid product IDs
                $productIds = Product::pluck('id')->toArray();
                
                // Convert $value to an array if it's not already one
                $selectedProducts = is_array($value) ? $value : [$value];
            
                // Check each selected product ID
                foreach ($selectedProducts as $productId) {
                    if (!in_array($productId, $productIds)) {
                        $fail('One or more selected products are invalid.');
                    }
                }
            }],
            
            'payment' => 'required|in:COD,Bank,Gcash',
            'mod' => 'required|in:Shopee,Lalamove,J&T',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:processing, Ofd, Delivered',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product.required' => 'The product field is required.',
            'product.in' => 'The selected product is invalid.',
        ];
    }
}
