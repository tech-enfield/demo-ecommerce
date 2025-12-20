<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantRequest extends FormRequest
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
        $id = $this->route('variant')?->id;

        return [
            'product_id' => ['required', 'exists:products,id'],
            'title' => ['required', 'string'],

            'sku' => [
                'required',
                'string',
                'unique:product_variants,sku,' . $id,
            ],
            'slug' => [
                'required',
                'string',
                'unique:product_variants,slug,' . $id,
            ],

            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],

            'price' => ['required', 'numeric'],
            'cost_price' => ['nullable', 'numeric'],

            'manage_stock' => ['required', 'in:0,1'],

            // If manage_stock = 1 → stock_quantity must NOT be null
            'stock_quantity' => [
                'nullable',
                'numeric',
                'required_if:manage_stock,1',
            ],

            'stock_status' => ['nullable', 'in:in_stock,out_of_stock,on_backorder'],

            'weight' => ['nullable', 'numeric'],
            'length' => ['nullable', 'numeric'],
            'width' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],

            'is_active' => ['nullable', 'in:0,1'],
            'on_sale' => ['nullable', 'in:0,1'],
            'is_best_selling' => ['nullable', 'in:0,1'],
            'is_featured' => ['nullable', 'in:0,1'],

            'sale_price' => ['nullable'],
            'sale_starts_at' => ['nullable', 'date'],
            'sale_ends_at' => ['nullable', 'date'],

            'published_at' => ['nullable', 'date'],

            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ];
    }
}
