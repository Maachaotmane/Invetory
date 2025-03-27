<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'      => 'nullable|exists:categories,id',
            'fournisseur_id'   => 'nullable|exists:fournisseurs,id',
            'unit_id'          => 'nullable|exists:units,id',
            'brand_id'         => 'nullable|exists:brands,id',
            'type_id'          => 'nullable|exists:types,id',
            'measure_id'       => 'nullable|exists:measures,id',
            'sub_category_id'  => 'nullable|exists:sub_categories,id',
            'store_id'         => 'nullable|exists:stores,id',
            'reference'        => 'required|string|unique:products,reference',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'images'           => 'nullable|array',
            'images.*'         => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'variants'         => 'nullable|array',
            'variants.*.variant'        => 'nullable|string',
            'variants.*.value'          => 'nullable|string',
            'variants.*.quantity'       => 'nullable|numeric|min:0',
            'variants.*.quantity_alert' => 'nullable|numeric|min:0',
            'variants.*.price'          => 'nullable|numeric|min:0',
            'variants.*.buying_price'   => 'nullable|numeric|min:0',
            'variants.*.images'          => 'nullable|array',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('variants')) {
            $variants = json_decode($this->input('variants'), true);

            $cleanedVariants = array_map(function ($variant) {
                return [
                    'variant' => $variant['variant'] ?? null,
                    'value' => $variant['value'] ?? null,
                    'quantity' => $variant['quantity'] ?? null,
                    'quantity_alert' => $variant['quantity_alert'] ?? null,
                    'price' => $variant['price'] ?? null,
                    'buying_price' => $variant['buying_price'] ?? null,
                    'images' => $variant['images'] ?? null
                ];
            }, $variants);

            $this->merge([
                'variants' => $cleanedVariants,
            ]);
        }
    }
}