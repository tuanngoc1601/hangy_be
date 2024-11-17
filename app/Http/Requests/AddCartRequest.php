<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends FormRequest
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
            'product_id' => 'string|required',
            'sub_product_id' => 'string|nullable',
            'quantity' => 'numeric|required|min:1',
            'price' => 'numeric|required',
            'flash_sale_price' => 'numeric|required',
            'amount' => 'numeric|required',
            'flash_sale_amount' => 'numeric|required'
        ];
    }
}
