<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Http\Requests\Base\BaseRequestForm;

class CreateProductRequest extends BaseRequestForm
{
    

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'product_status' => 'required|in:active,inactive',
            'product_main_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'product_purchasing_count' => 'required|integer',
        ];
    }
}