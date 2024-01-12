<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\BaseRequestForm;
use Illuminate\Foundation\Http\FormRequest;

class AddProductToCartRequest extends BaseRequestForm
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|max:100000|min:0',
        ];
    }
}
