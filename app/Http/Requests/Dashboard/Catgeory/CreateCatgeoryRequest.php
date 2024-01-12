<?php

namespace App\Http\Requests\Dashboard\Catgeory;

use App\Http\Requests\Base\BaseRequestForm;

class CreateCatgeoryRequest extends BaseRequestForm
{
    

    public function rules()
    {
        return [
            'category_image'=>'required', 
            'is_active' =>'required',
        ];
    }
}