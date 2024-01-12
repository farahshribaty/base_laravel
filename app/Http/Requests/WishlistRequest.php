<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\BaseRequestForm;
use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends BaseRequestForm
{
    
    public function rules()
    {
        return [
            'product_id'=>'required|exists:products,id',
            'user_id'=>'required|exists:products,id'
        ];
    }
}
