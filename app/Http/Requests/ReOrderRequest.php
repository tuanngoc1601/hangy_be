<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReOrderRequest extends FormRequest
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
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|string',
            'order_items.*.sub_product_id' => 'string|nullable',
            'order_items.*.quantity' => 'numeric|required|min:1',
            'order_items.*.price' => 'numeric|required',
            'order_items.*.sub_total_price' => 'numeric|required',
        ];
    }
}
