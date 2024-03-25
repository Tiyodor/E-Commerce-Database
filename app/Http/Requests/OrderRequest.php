<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'Product' => 'required|in:SD,EG,HG,RG,MG,PG,HI-RES,1/100',
            'payment' => 'required|in:COD, Bank, Gcash',
            'mod' => 'required|in:Shopee, Lalamove, J&T',
            'total' => 'required',
            'status' => 'required',
        ];
    }
}
